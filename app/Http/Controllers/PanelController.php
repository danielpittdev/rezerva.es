<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use App\Models\Servicios;
use App\Models\Empleado;
use App\Models\Clientes;
use App\Models\Reserva;
use App\Models\Facturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PanelController extends Controller
{
    public function inicio()
    {
        $usuario = Auth::user();
        $negociosIds = Negocios::where('usuario_id', $usuario->id)->pluck('id');
        $serviciosIds = Servicios::whereIn('negocio_id', $negociosIds)->pluck('id');

        // Estadísticas principales
        $totalNegocios = $negociosIds->count();
        $totalServicios = $serviciosIds->count();
        $totalEmpleados = Empleado::whereIn('negocio_id', $negociosIds)->count();
        $totalClientes = Clientes::whereIn('negocio_id', $negociosIds)->count();

        // Reservas
        $hoy = Carbon::today();
        $inicioSemana = Carbon::now()->startOfWeek();
        $inicioMes = Carbon::now()->startOfMonth();

        $reservasHoy = Reserva::whereIn('servicio_id', $serviciosIds)
            ->whereDate('fecha', $hoy)
            ->count();

        $reservasSemana = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('fecha', '>=', $inicioSemana)
            ->count();

        $reservasMes = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('fecha', '>=', $inicioMes)
            ->count();

        $totalReservas = Reserva::whereIn('servicio_id', $serviciosIds)->count();

        // Próximas reservas (las 5 más cercanas)
        $proximasReservas = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('fecha', '>=', Carbon::now())
            ->where('estado', '!=', 'cancelado')
            ->orderBy('fecha', 'asc')
            ->with(['servicio', 'cliente'])
            ->limit(5)
            ->get();

        // Clientes recientes
        $clientesRecientes = Clientes::whereIn('negocio_id', $negociosIds)
            ->orderBy('created_at', 'desc')
            ->with('negocio')
            ->limit(5)
            ->get();

        // Reservas por estado
        $reservasPendientes = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('estado', 'pendiente')
            ->count();

        $reservasConfirmadas = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('estado', 'confirmado')
            ->count();

        $reservasCompletadas = Reserva::whereIn('servicio_id', $serviciosIds)
            ->where('estado', 'completado')
            ->count();

        // Reservas por día de la semana actual (para gráfico)
        $reservasPorDia = [];
        for ($i = 0; $i < 7; $i++) {
            $dia = $inicioSemana->copy()->addDays($i);
            $reservasPorDia[] = Reserva::whereIn('servicio_id', $serviciosIds)
                ->whereDate('fecha', $dia)
                ->count();
        }

        // Ingresos (si hay facturas)
        $ingresosMes = Facturas::whereIn('negocio_id', $negociosIds)
            ->where('created_at', '>=', $inicioMes)
            ->sum('total');

        // Negocios del usuario
        $negocios = Negocios::where('usuario_id', $usuario->id)->get();

        return view('panel.inicio', compact(
            'totalNegocios',
            'totalServicios',
            'totalEmpleados',
            'totalClientes',
            'reservasHoy',
            'reservasSemana',
            'reservasMes',
            'totalReservas',
            'proximasReservas',
            'clientesRecientes',
            'reservasPendientes',
            'reservasConfirmadas',
            'reservasCompletadas',
            'reservasPorDia',
            'ingresosMes',
            'negocios'
        ));
    }

    public function negocios()
    {
        return view('panel.negocios');
    }

    public function empleados()
    {
        return view('panel.empleados');
    }

    public function servicios()
    {
        return view('panel.servicios');
    }

    public function clientes()
    {
        return view('panel.clientes');
    }

    public function reservas()
    {
        return view('panel.reservas');
    }

    public function horarios()
    {
        return view('panel.horarios');
    }

    public function facturacion()
    {
        return view('panel.facturacion');
    }

    public function ajustes()
    {
        return view('panel.ajustes');
    }
}
