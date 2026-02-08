<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Horarios;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\HorarioExcepcional;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function test()
    {
        return 'hola';
    }

    public function verificarSesionCliente()
    {
        if (!session()->has('cliente')) {
            return response()->json(['error' => 'No autenticado'], 401);
        }

        return response()->json(['redirect' => route('checkout')]);
    }

    public function crearCliente(Request $request)
    {
        $datos = $request->validate([
            'negocio' => 'required|uuid|exists:negocios,uuid',
            'servicio' => 'required|uuid|exists:servicios,uuid',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
        ]);

        // Limpiar sesión anterior y guardar nueva
        session()->forget('cliente');
        session(['cliente' => $datos]);

        return response()->json(['redirect' => route('checkout')]);
    }

    public function horasDisponibles(Request $request)
    {
        $request->validate([
            'negocio' => 'required|uuid|exists:negocios,uuid',
            'servicio' => 'required|uuid|exists:servicios,uuid',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        $negocio = Negocios::where('uuid', $request->negocio)->first();
        $servicio = Servicios::where('uuid', $request->servicio)->first();
        $fecha = Carbon::parse($request->fecha);
        $diaSemana = strtolower($fecha->format('l'));

        // Duración del servicio: si es null, slots cada hora (60 min)
        $duracion = (int) ($servicio->duracion ?? 60);
        if ($duracion < 30) {
            $duracion = (int) 15;
        }

        // Obtener horario (excepción o regular)
        $excepcion = HorarioExcepcional::where('negocio_id', $negocio->id)
            ->whereDate('fecha', $fecha->format('Y-m-d'))
            ->first();

        if ($excepcion?->cerrado) {
            return response()->json(['horas' => [], 'mensaje' => 'Cerrado este día']);
        }

        $franjaInicio = $excepcion?->franja_inicio;
        $franjaFinal = $excepcion?->franja_final;

        if (!$franjaInicio || !$franjaFinal) {
            $horario = Horarios::where('negocio_id', $negocio->id)
                ->where('dia', $diaSemana)
                ->first();

            if (!$horario) {
                return response()->json(['horas' => [], 'mensaje' => 'Cerrado este día']);
            }

            $franjaInicio = $horario->franja_inicio;
            $franjaFinal = $horario->franja_final;
        }

        // Generar slots
        $inicio = Carbon::parse($fecha->format('Y-m-d') . ' ' . $franjaInicio);
        $fin = Carbon::parse($fecha->format('Y-m-d') . ' ' . $franjaFinal);
        $ahora = Carbon::now();
        $esHoy = $fecha->isToday();

        $slots = [];
        $actual = $inicio->copy();

        while ($actual->copy()->addMinutes($duracion)->lte($fin)) {
            if (!$esHoy || $actual->gt($ahora)) {
                $slots[] = $actual->format('H:i');
            }
            $actual->addMinutes($duracion);
        }

        // Obtener reservas existentes
        $reservas = Reserva::where('negocio_id', $negocio->id)
            ->whereDate('fecha', $fecha->format('Y-m-d'))
            ->whereIn('estado', ['pendiente', 'confirmado'])
            ->with('servicio')
            ->get();

        // Calcular slots ocupados
        $slotsOcupados = [];
        foreach ($reservas as $reserva) {
            $inicioReserva = $reserva->fecha;
            $duracionReserva = (int) ($reserva->servicio->duracion ?? 60);
            $finReserva = $inicioReserva->copy()->addMinutes($duracionReserva);

            foreach ($slots as $slot) {
                $slotInicio = Carbon::parse($fecha->format('Y-m-d') . ' ' . $slot);
                $slotFin = $slotInicio->copy()->addMinutes($duracion);

                // Solapamiento: slotInicio < finReserva AND slotFin > inicioReserva
                if ($slotInicio->lt($finReserva) && $slotFin->gt($inicioReserva)) {
                    $slotsOcupados[] = $slot;
                }
            }
        }

        $horasDisponibles = array_values(array_diff($slots, array_unique($slotsOcupados)));

        return response()->json(['horas' => $horasDisponibles]);
    }

    public function contacto(Request $request)
    {
        $validar = $request->validate([
            'nombre' => 'required|string|max:30',
            'apellido' => 'required|string|max:40',
            'email' => 'required|email|max:100',
            'mensaje' => 'required|string|max:500',
        ]);

        // Para API: generar JWT token
        Mail::send('components.email.soporte.comunicativo', [
            'datos' => $request,
        ], function ($message) use ($request) {
            $message->to('contacto@rezerva.es', $request->nombre . ' ' . $request->apellido)
                ->subject('Petición de soporte técnico');
        });

        return redirect(route('contacto'));

        return response()->json([
            'mensaje' => 'Mensaje enviado correctamente',
            'redirect' => route('contacto'),
        ], 200);
    }





    public function check_evento(Request $request)
    {
        $datos = $request->validate([
            'evento' => 'required|uuid|exists:eventos,uuid',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email',
        ]);

        // Limpiar sesión anterior y guardar nueva
        session()->forget('cliente');
        session(['cliente' => $datos]);

        return response()->json(['redirect' => route('checkout_evento')]);
    }
}
