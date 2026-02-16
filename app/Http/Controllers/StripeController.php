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

        // Validar que el evento tenga precio en Stripe
        if (empty($evento->stripe_price)) {
            session()->forget('evento_pendiente');
            return redirect()->route('evento', ['evento' => $evento->uuid])
                ->with('error', 'El evento no tiene configurado el pago con tarjeta.');
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        // Buscar o crear customer en la cuenta conectada
        if (empty($cliente->stripe_id)) {
            try {
                // Buscar si ya existe un customer con ese email en la cuenta conectada
                $existentes = $stripe->customers->all([
                    'email' => $cliente->email,
                    'limit' => 1,
                ], ['stripe_account' => $negocio->stripe_account_id]);

                if (!empty($existentes->data)) {
                    $customer = $existentes->data[0];
                } else {
                    $customer = $stripe->customers->create([
                        'email' => $cliente->email,
                        'name' => trim($cliente->nombre . ' ' . $cliente->apellido),
                        'phone' => $cliente->telefono,
                    ], ['stripe_account' => $negocio->stripe_account_id]);
                }

                $cliente->update(['stripe_id' => $customer->id]);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                Log::error("Error buscando/creando customer en Connect: {$e->getMessage()}");
            }
        }

        // Toppings
        $lineItems = [[
            'price' => $evento->stripe_price,
            'quantity' => $cantidad,
        ]];

        if ($toppings) {
            foreach ($toppings as $topping) {
                if (empty($topping['stripe_price'])) {
                    continue;
                }
                $lineItems[] = [
                    'price' => $topping['stripe_price'],
                    'quantity' => $cantidad,
                ];
            }
        }

        $reservaEvento = Str::uuid();

        // Comisión fija: 0,35€ por entrada
        $comision = (int) (35 * $cantidad);

        $checkoutData = [
            'line_items' => $lineItems,
            'mode' => 'payment',
            'payment_intent_data' => [
                'application_fee_amount' => $comision,
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

        if ($cliente->stripe_id) {
            $checkoutData['customer'] = $cliente->stripe_id;
        }

        try {
            $checkout = $stripe->checkout->sessions->create(
                $checkoutData,
                ['stripe_account' => $negocio->stripe_account_id]
            );

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
