<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Planes;
use GuzzleHttp\Client;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Registros;
use App\Models\Servicios;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReservaEvento;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function crear_suscripcion(Request $request)
    {
        $validacion = $request->validate([
            'plan' => 'required|string|exists:planes,slug'
        ]);

        $plan = Planes::where('slug', $request->plan)->first();

        $url = $request->user()
            ->newSubscription($plan->slug, $plan->stripe_id)
            // ->trialDays(0)
            ->allowPromotionCodes()
            ->checkout([
                'metadata' => ['usuario' => Auth::user()->id],
                'success_url' => route('inicio'),
                'cancel_url' => route('inicio'),
            ]);

        return response()->json([
            'redirect' => $url->url
        ]);
    }

    public function pre_checkout(Request $request)
    {
        $datos = session()->get('reserva_pendiente');

        // Cliente
        $cliente = Clientes::whereUuid($datos['cliente'])->first();

        // Servicio y negocio
        $servicio = Servicios::whereId($datos['servicio_id'])->first();
        $negocio = $servicio->negocio;

        // Verificar que el negocio tenga cuenta Connect
        if (empty($negocio->stripe_account_id)) {
            return redirect()->back()->with('error', 'El negocio no tiene cuenta de Stripe conectada');
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        // Crear customer en la cuenta conectada si no existe
        if (empty($cliente->stripe_id)) {
            try {
                $customer = $stripe->customers->create([
                    'email' => $cliente->email,
                    'name' => trim($cliente->nombre . ' ' . $cliente->apellido),
                    'phone' => $cliente->telefono,
                    'metadata' => [
                        'cliente_uuid' => $cliente->uuid,
                        'negocio_id' => $negocio->id,
                    ],
                ], ['stripe_account' => $negocio->stripe_account_id]);

                $cliente->update(['stripe_id' => $customer->id]);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                Log::error("Error creando customer en Connect: {$e->getMessage()}");
            }
        }

        // Crea la reserva
        $reserva = Reserva::create([
            'servicio_id' => $datos['servicio_id'],
            'cliente_id' => $cliente->id,
            'negocio_id' => $datos['negocio_id'],
            'empleado_id' => $empleado->id ?? null,
            'fecha' => $datos['fecha'],
            'nota' => $datos['nota'] ?? null,
            'estado' => 'pago_pendiente',
        ]);

        // Guardar cliente_id en la sesión para usarlo después
        session()->put('reserva_pendiente.cliente_id', $cliente->id);

        // Calcular comisión (5% del precio del servicio)
        $precioEnCentimos = (int) ($servicio->precio * 100);
        $comision = (int) ($precioEnCentimos * 0.05);

        $checkoutData = [
            'line_items' => [[
                'price' => $servicio->stripe_id,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_intent_data' => [
                'application_fee_amount' => $comision,
            ],
            'metadata' => [
                'fn' => 1,
                'reserva' => $reserva->uuid,
            ],
            'success_url' => route('reserva', ['reserva' => $reserva->uuid]),
            'cancel_url' => route('inicio'),
        ];

        // Asociar customer si existe
        if ($cliente->stripe_id) {
            $checkoutData['customer'] = $cliente->stripe_id;
        }

        $checkout = $stripe->checkout->sessions->create(
            $checkoutData,
            ['stripe_account' => $negocio->stripe_account_id]
        );

        return redirect($checkout->url);
    }

    public function pre_checkout_evento(Request $request)
    {
        $datos = session()->get('evento_pendiente');

        if (!$datos) {
            return redirect()->route('inicio');
        }

        $cliente = Clientes::findOrFail($datos['cliente_id']);
        $evento = Evento::findOrFail($datos['evento_id']);
        $negocio = $evento->negocio;
        $toppings = $datos['toppings'] ?? [];
        $cantidad = $datos['cantidad'];
        $total = $datos['total'];
        $captions = $datos['captions'] ?? [];

        // Validar que el negocio tenga Stripe Connect
        if (empty($negocio->stripe_account_id)) {
            session()->forget('evento_pendiente');
            return redirect()->route('evento', ['evento' => $evento->uuid])
                ->with('error', 'El negocio no tiene cuenta de Stripe conectada. No se puede procesar el pago con tarjeta.');
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        $reservaEvento = Str::uuid();

        // Coste de servicios: 0,90€ por entrada (máximo 10)
        $cantidadFee = min($cantidad, 10);
        $comision = 90 * $cantidadFee;

        // Destination Charges: todos los precios inline con price_data
        $lineItems = [[
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => (int) round($evento->precio * 100),
                'product_data' => ['name' => $evento->nombre],
            ],
            'quantity' => $cantidad,
        ]];

        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => 90,
                'product_data' => ['name' => 'Coste de servicios'],
            ],
            'quantity' => $cantidadFee,
        ];

        foreach ($toppings as $topping) {
            if (empty($topping['precio'])) {
                continue;
            }
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => (int) round($topping['precio'] * 100),
                    'product_data' => ['name' => $topping['nombre'] ?? 'Extra'],
                ],
                'quantity' => $cantidad,
            ];
        }

        $checkoutData = [
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $cliente->email,
            'payment_intent_data' => [
                'application_fee_amount' => $comision,
                'on_behalf_of' => $negocio->stripe_account_id,
                'transfer_data' => [
                    'destination' => $negocio->stripe_account_id,
                    // Transferencia explícita: solo el precio de la entrada × cantidad.
                    // Los toppings NO se incluyen aquí → se quedan en la plataforma.
                    // Si los toppings deben ir al comercio, elimina este 'amount'.
                    'amount' => (int) round($evento->precio * 100) * $cantidad,
                ],
            ],
            'metadata' => [
                'fn' => 2,
                'cantidad' => $cantidad,
                'total' => $total,
                'evento_id' => $evento->id,
                'cliente_id' => $cliente->id,
                'reserva_evento' => $reservaEvento,
                'toppings' => json_encode(collect($toppings)->pluck('id')->values()),
                'captions' => json_encode($captions)
            ],
            'success_url' => route('reserva_evento', ['reserva' => $reservaEvento]),
            'cancel_url' => route('evento', ['evento' => $evento->uuid]),
        ];

        try {
            // Destination Charge: sesión en la cuenta plataforma (sin stripe_account)
            $checkout = $stripe->checkout->sessions->create($checkoutData);

            session()->forget('evento_pendiente');

            return redirect($checkout->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error("Error creando checkout de evento: {$e->getMessage()}");

            session()->forget('evento_pendiente');

            return redirect()->route('evento', ['evento' => $evento->uuid])
                ->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function billing_portal(Request $request)
    {
        $url = $request->user()->redirectToBillingPortal(route('ajustes'));

        return response()->json([
            'redirect' => $url->getTargetUrl()
        ]);
    }
}
