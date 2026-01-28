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

    public function empleados()
    {
        return view('panel.empleados');
    }
}
