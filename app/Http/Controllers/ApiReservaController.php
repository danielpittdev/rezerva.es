<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Negocios;
use App\Models\Reserva;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiReservaController extends Controller
{
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
        ]);

        // Obtener datos del cliente de la sesión
        if (!session()->has('cliente')) {
            return response()->json(['error' => 'Sesión expirada'], 401);
        }

        $datosCliente = session('cliente');

        // Obtener negocio y servicio
        $negocio = Negocios::where('uuid', $datosCliente['negocio'])->first();
        $servicio = Servicios::where('uuid', $datosCliente['servicio'])->first();

        if (!$negocio || !$servicio) {
            return response()->json(['error' => 'Negocio o servicio no encontrado'], 404);
        }

        // Crear fecha completa
        $fechaReserva = Carbon::parse($request->fecha . ' ' . $request->hora);

        // Verificar que la hora no esté ocupada
        $reservaExistente = Reserva::where('servicio_id', $servicio->id)
            ->where('fecha', $fechaReserva)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->exists();

        if ($reservaExistente) {
            return response()->json(['error' => 'Esta hora ya no está disponible'], 409);
        }

        // Buscar o crear cliente
        $cliente = Clientes::firstOrCreate(
            [
                'email' => $datosCliente['email'],
                'negocio_id' => $negocio->id,
            ],
            [
                'nombre' => $datosCliente['nombre'],
                'apellido' => $datosCliente['apellido'],
            ]
        );

        // Crear la reserva
        $reserva = Reserva::create([
            'servicio_id' => $servicio->id,
            'cliente_id' => $cliente->id,
            'fecha' => $fechaReserva,
            'estado' => $servicio->pago_online ? 'pendiente_pago' : 'confirmada',
        ]);

        // Si el servicio requiere pago online
        if ($servicio->pago_online && $servicio->stripe_id) {
            try {
                $stripe = new \Stripe\StripeClient(config('cashier.secret'));

                // Crear sesión de Checkout
                $checkoutSession = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price' => $servicio->stripe_id,
                        'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => route('reserva.confirmacion', ['reserva' => $reserva->uuid]) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('reserva.cancelada', ['reserva' => $reserva->uuid]),
                    'customer_email' => $cliente->email,
                    'metadata' => [
                        'reserva_id' => $reserva->id,
                        'reserva_uuid' => $reserva->uuid,
                        'servicio_id' => $servicio->id,
                        'cliente_id' => $cliente->id,
                    ],
                ]);

                // Guardar session_id en la reserva
                $reserva->update(['stripe_session_id' => $checkoutSession->id]);

                return response()->json([
                    'success' => true,
                    'pago_requerido' => true,
                    'checkout_url' => $checkoutSession->url,
                ]);

            } catch (\Exception $e) {
                // Si falla Stripe, eliminar la reserva
                $reserva->delete();

                return response()->json([
                    'error' => 'Error al procesar el pago: ' . $e->getMessage()
                ], 500);
            }
        }

        // Limpiar sesión del cliente
        session()->forget('cliente');

        return response()->json([
            'success' => true,
            'pago_requerido' => false,
            'redirect' => route('reserva.confirmacion', ['reserva' => $reserva->uuid]),
            'reserva' => [
                'uuid' => $reserva->uuid,
                'fecha' => $fechaReserva->format('d/m/Y'),
                'hora' => $fechaReserva->format('H:i'),
                'servicio' => $servicio->nombre,
                'negocio' => $negocio->nombre,
            ]
        ]);
    }

    public function confirmacion($uuid)
    {
        $reserva = Reserva::where('uuid', $uuid)->firstOrFail();

        // Si viene de Stripe, verificar el pago
        if (request()->has('session_id')) {
            try {
                $stripe = new \Stripe\StripeClient(config('cashier.secret'));
                $session = $stripe->checkout->sessions->retrieve(request('session_id'));

                if ($session->payment_status === 'paid') {
                    $reserva->update(['estado' => 'confirmada']);
                    session()->forget('cliente');
                }
            } catch (\Exception $e) {
                // Log error
            }
        }

        $reserva->load(['servicio', 'cliente']);
        $negocio = $reserva->servicio->negocio;

        return view('reserva.confirmacion', compact('reserva', 'negocio'));
    }

    public function cancelada($uuid)
    {
        $reserva = Reserva::where('uuid', $uuid)->firstOrFail();

        // Marcar como cancelada
        $reserva->update(['estado' => 'cancelada']);

        $reserva->load(['servicio', 'cliente']);
        $negocio = $reserva->servicio->negocio;

        return view('reserva.cancelada', compact('reserva', 'negocio'));
    }
}
