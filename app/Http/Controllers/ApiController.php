<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\ReservaEvento;
use App\Jobs\EnviarCorreoEvento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function test()
    {
        return 'hola';
    }

    public function evento_avisar(Request $request)
    {
        $evento = Evento::whereUuid($request->evento)->with('negocio')->firstOrFail();

        $validacion = $request->validate([
            'titulo' => 'required|string|max:50',
            'cuerpo' => 'required|string|max:500'
        ]);

        // Cobrar 0,90€ al usuario autenticado antes de enviar
        $usuario = $request->user();

        $metodo = $usuario->defaultPaymentMethod() ?? $usuario->paymentMethods()->first();

        if (!$metodo) {
            return response()->json([
                'errors' => ['pago' => ['No tienes un método de pago configurado. Añade uno para poder enviar correos masivos.']]
            ], 422);
        }

        try {
            $usuario->charge(100, $metodo->id, [
                'description' => 'Envío masivo - Evento: ' . $evento->nombre,
                'payment_method_types' => ['card'],
                'currency' => 'EUR'
            ]);
        } catch (\Laravel\Cashier\Exceptions\IncompletePayment $e) {
            return response()->json([
                'errors' => ['pago' => ['El pago no se ha podido completar. Verifica tu método de pago.']]
            ], 402);
        }

        $reservas = $evento->reservas()->with('cliente')->get();
        $encolados = 0;

        foreach ($reservas as $reserva) {
            if (!$reserva->cliente->email) {
                continue;
            }

            EnviarCorreoEvento::dispatch(
                $reserva->id,
                $validacion['titulo'],
                $validacion['cuerpo'],
            );

            $encolados++;
        }

        return response()->json([
            'nombre' => $evento->nombre,
            'encolados' => $encolados,
            'total' => $reservas->count(),
        ]);
    }

    public function evento_avisar_individual(Request $request)
    {
        $request->validate([
            'reserva' => 'required|uuid',
            'asunto' => 'required|string|max:100',
            'cuerpo' => 'required|string|max:1000',
        ]);

        $reserva = ReservaEvento::whereUuid($request->reserva)->with('cliente', 'evento.negocio')->firstOrFail();
        $cliente = $reserva->cliente;
        $negocio = $reserva->evento->negocio;

        if (!$cliente->email) {
            return response()->json([
                'errors' => ['email' => ['Este cliente no tiene correo electrónico registrado']]
            ], 422);
        }

        Mail::send('components.email.evento.aviso-individual', [
            'asunto' => $request->asunto,
            'cuerpo' => $request->cuerpo,
            'cliente' => $cliente,
            'negocio' => $negocio,
        ], function ($message) use ($cliente, $request) {
            $message->to($cliente->email, $cliente->nombre . ' ' . $cliente->apellido)
                ->subject($request->asunto);
        });

        return response()->json([
            'mensaje' => 'Correo enviado correctamente',
        ]);
    }
}
