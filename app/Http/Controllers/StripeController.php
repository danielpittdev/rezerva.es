<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Registros;
use App\Models\Servicios;
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

    public function billing_portal(Request $request)
    {
        $url = $request->user()->redirectToBillingPortal(route('ajustes'));

        return response()->json([
            'redirect' => $url->getTargetUrl()
        ]);
    }
}
