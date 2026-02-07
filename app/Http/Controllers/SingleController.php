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
        return view('panel.single.evento', compact('evento'));
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
