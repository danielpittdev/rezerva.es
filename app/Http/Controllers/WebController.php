<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Evento;
use App\Models\Reserva;
use App\Models\Horarios;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\HorarioExcepcional;
use App\Models\ReservaEvento;
use Symfony\Contracts\EventDispatcher\Event;

class WebController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function negocio($id)
    {
        $negocio = Negocios::where('slug', $id)->first();
        session()->forget('cliente');
        return view('negocio', compact('negocio'));
    }

    public function evento($id)
    {
        $evento = Evento::whereUuid($id)->first();
        session()->forget('cliente');
        return view('evento', compact('evento'));
    }

    public function reserva($id)
    {
        $reserva = Reserva::whereUuid($id)->first();
        session()->forget('cliente');
        session()->forget('reserva_pendiente');
        return view('reserva', compact('reserva'));
    }

    public function reserva_evento($id)
    {
        $evento = ReservaEvento::whereUuid($id)->first();
        session()->forget('cliente');
        session()->forget('reserva_pendiente');
        return view('reserva_evento', compact('evento'));
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

    public function checkout_evento()
    {
        if (!session()->has('cliente')) {
            return redirect('/');
        }

        $cliente = session('cliente');
        $evento = Evento::where('uuid', $cliente['evento'])->first();

        return view('checkout_evento', compact('cliente', 'evento'));
    }

    public function contacto()
    {
        return view('web.categorias.contacto');
    }

    # Categorias
    public function reservas()
    {
        return view('web.categorias.reservas');
    }
    public function psicologia()
    {
        return view('web.categorias.psicologia');
    }
    public function empleados()
    {
        return view('web.categorias.empleados');
    }
    public function carta_qr()
    {
        return view('web.categorias.carta_qr');
    }
    public function horarios()
    {
        return view('web.categorias.horarios');
    }
    public function clientes()
    {
        return view('web.categorias.clientes');
    }
    public function franquicias()
    {
        return view('web.especial.franquicias');
    }
    public function manager()
    {
        return view('web.especial.manager');
    }

    # Legal
    public function contrato()
    {
        return view('web.legal.contrato');
    }
    public function cookies()
    {
        return view('web.legal.cookies');
    }
    public function legal()
    {
        return view('web.legal.legal');
    }
    public function privacidad()
    {
        return view('web.legal.privacidad');
    }
}
