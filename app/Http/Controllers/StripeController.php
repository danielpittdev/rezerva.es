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

        // Servicio 
        $servicio = Servicios::whereId($datos['servicio_id'])->first();

        // Crea la reserva
        $reserva = Reserva::create([
            'servicio_id' => $datos['servicio_id'],
            'cliente_id' => $cliente->id,
            'negocio_id' => $datos['negocio_id'],
            'empleado_id' => $empleado->id ?? null,
            'fecha' => $datos['fecha'],
            'estado' => 'pago_pendiente',
        ]);

        // Guardar cliente_id en la sesión para usarlo después
        session()->put('reserva_pendiente.cliente_id', $cliente->id);

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        $checkout = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price' => $servicio->stripe_id,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer' => $cliente->stripe_id,
            'metadata' => [
                'reserva' => $reserva->uuid,
            ],
            'success_url' => route('inicio') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('inicio'),
        ]);

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
