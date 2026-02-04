<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Registros;
use App\Models\Servicios;
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
        $servicio = Servicios::whereUuid($request->servicio)->first();

        if (!$servicio || !$servicio->pago_online || !$servicio->stripe_id) {
            return redirect('/')->with('error', 'El servicio no tiene pago online configurado');
        }

        $reserva_pendiente = session()->get('reserva_pendiente');

        if (!$reserva_pendiente) {
            return redirect('/')->with('error', 'No hay reserva pendiente');
        }

        $datos_cliente = $reserva_pendiente['datos_cliente'];
        $negocio_id = $reserva_pendiente['negocio_id'];

        // Buscar o crear el cliente en la base de datos
        $cliente = Clientes::where('email', $datos_cliente['email'])
            ->where('nombre', $datos_cliente['nombre'])
            ->where('apellido', $datos_cliente['apellido'])
            ->first();

        if (!$cliente) {
            $cliente = Clientes::create([
                'nombre' => $datos_cliente['nombre'],
                'apellido' => $datos_cliente['apellido'],
                'email' => $datos_cliente['email'],
                'negocio_id' => $negocio_id
            ]);
        }

        // Crear customer en Stripe si no existe
        if (!$cliente->stripe_id) {
            $cliente->createAsStripeCustomer([
                'name' => $cliente->nombre . ' ' . $cliente->apellido,
                'email' => $cliente->email,
            ]);
        }

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
                'servicio_id' => $servicio->id,
                'negocio_id' => $negocio_id,
                'cliente_id' => $cliente->id,
                'fecha' => $reserva_pendiente['fecha'],
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
