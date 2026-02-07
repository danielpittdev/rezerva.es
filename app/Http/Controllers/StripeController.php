<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\Evento;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Registros;
use App\Models\Servicios;
use App\Models\ReservaEvento;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
        $cantidad = $datos['cantidad'];
        $total = $datos['total'];

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

        // Crear la reserva del evento
        $reservaEvento = ReservaEvento::create([
            'metodo_pago' => 'tarjeta',
            'pagado' => false,
            'confirmacion' => false,
            'cantidad' => $cantidad,
            'total' => $total,
            'evento_id' => $evento->id,
            'cliente_id' => $cliente->id,
        ]);

        // Descontar stock
        $evento->decrement('stock', $cantidad);

        // Calcular comisión (5%)
        $precioEnCentimos = (int) ($total * 100);
        $comision = (int) ($precioEnCentimos * 0.05);

        $checkoutData = [
            'line_items' => [[
                'price' => $evento->stripe_price,
                'quantity' => $cantidad,
            ]],
            'mode' => 'payment',
            'payment_intent_data' => [
                'application_fee_amount' => $comision,
            ],
            'metadata' => [
                'reserva_evento' => $reservaEvento->uuid,
            ],
            'success_url' => route('inicio'),
            'cancel_url' => route('inicio'),
        ];

        if ($cliente->stripe_id) {
            $checkoutData['customer'] = $cliente->stripe_id;
        }

        $checkout = $stripe->checkout->sessions->create(
            $checkoutData,
            ['stripe_account' => $negocio->stripe_account_id]
        );

        session()->forget('evento_pendiente');

        return redirect($checkout->url);
    }

    public function billing_portal(Request $request)
    {
        $url = $request->user()->redirectToBillingPortal(route('ajustes'));

        return response()->json([
            'redirect' => $url->getTargetUrl()
        ]);
    }
}
