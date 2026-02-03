<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function negocio($id)
    {
        $negocio = Negocios::where('slug', $id)->first();
        return view('negocio', compact('negocio'));
    }

    public function checkout()
    {
        if (!session()->has('cliente')) {
            return redirect('/');
        }

        $cliente = session('cliente');
        $negocio = Negocios::where('uuid', $cliente['negocio'])->first();
        $servicio = Servicios::where('uuid', $cliente['servicio'])->first();

        return view('checkout', compact('cliente', 'negocio', 'servicio'));
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

        // Guardar en sesión
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
        $fecha = \Carbon\Carbon::parse($request->fecha);
        $diaSemana = $fecha->dayOfWeekIso; // 1 = Lunes, 7 = Domingo

        // Obtener horario del negocio para ese día
        $horario = \App\Models\Horarios::where('negocio_id', $negocio->id)
            ->where('dia', $diaSemana)
            ->first();

        if (!$horario) {
            return response()->json(['horas' => [], 'mensaje' => 'Cerrado este día']);
        }

        // Duración del servicio en minutos
        $duracion = (int) $servicio->duracion ?? 30;

        // Generar slots
        $inicio = \Carbon\Carbon::parse($fecha->format('Y-m-d') . ' ' . $horario->franja_inicio);
        $fin = \Carbon\Carbon::parse($fecha->format('Y-m-d') . ' ' . $horario->franja_final);

        $slots = [];
        $actual = $inicio->copy();

        while ($actual->copy()->addMinutes($duracion)->lte($fin)) {
            $slots[] = $actual->format('H:i');
            $actual->addMinutes($duracion);
        }

        // Obtener reservas existentes para ese día y servicio
        $reservas = \App\Models\Reserva::where('servicio_id', $servicio->id)
            ->whereDate('fecha', $fecha->format('Y-m-d'))
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->pluck('fecha')
            ->map(fn($f) => \Carbon\Carbon::parse($f)->format('H:i'))
            ->toArray();

        // Filtrar slots ocupados
        $horasDisponibles = array_values(array_diff($slots, $reservas));

        return response()->json(['horas' => $horasDisponibles]);
    }
}
