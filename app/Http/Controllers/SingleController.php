<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Empleado;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function negocio($id)
    {
        $negocio = Negocios::whereUuid($id)->first();
        return view('panel.single.negocio', compact('negocio'));
    }

    public function empleado($id)
    {
        $empleado = Empleado::whereUuid($id)->with('negocio')->first();
        return view('panel.single.empleado', compact('empleado'));
    }

    public function evento($id)
    {
        $evento = Evento::whereUuid($id)->with('negocio')->first();
        $reservas = $evento->reservas()->with('cliente')->get();

        // return $reservas->pluck('cliente');

        // Entradas vendidas por día (agrupado por fecha de created_at)
        $ventasPorDia = $reservas->groupBy(fn($r) => $r->created_at->format('d M'))
            ->map(fn($grupo) => $grupo->sum('cantidad'));

        $chartLabels = $ventasPorDia->keys()->values()->toArray();
        $chartData = $ventasPorDia->values()->toArray();

        // KPIs
        $totalVendidas = $reservas->sum('cantidad');
        $ingresosTotales = $reservas->sum('total');
        $stockOriginal = $totalVendidas + ($evento->stock ?? 0);
        $porcentajeOcupacion = $stockOriginal > 0 ? round(($totalVendidas / $stockOriginal) * 100) : 0;

        // Distribución por método de pago
        $metodosPago = $reservas->groupBy('metodo_pago')
            ->map(fn($grupo) => $grupo->sum('cantidad'));

        $metodoLabels = $metodosPago->keys()->map(fn($m) => ucfirst($m))->values()->toArray();
        $metodoData = $metodosPago->values()->toArray();

        return view('panel.single.evento', compact(
            'evento',
            'reservas',
            'chartLabels',
            'chartData',
            'totalVendidas',
            'ingresosTotales',
            'stockOriginal',
            'porcentajeOcupacion',
            'metodoLabels',
            'metodoData'
        ));
    }

    public function servicio($id)
    {
        $servicio = Servicios::whereUuid($id)->first();
        return view('panel.single.servicio', compact('servicio'));
    }

    public function reserva($id)
    {
        $reserva = Reserva::whereUuid($id)->first();
        return view('panel.single.reserva', compact('reserva'));
    }

    public function cliente($id)
    {
        $cliente = Clientes::whereUuid($id)->with(['negocio'])->first();
        return view('panel.single.cliente', compact('cliente'));
    }
}
