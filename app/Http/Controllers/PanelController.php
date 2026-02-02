<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function inicio()
    {
        return view('panel.inicio');
    }

    public function negocios()
    {
        return view('panel.negocios');
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

    public function ajustes()
    {
        return view('panel.ajustes');
    }
}
