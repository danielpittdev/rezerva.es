<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }

    public function negocio($id)
    {
        $negocio = Negocios::whereUuid($id)->fist();
        return view('negocio', compact($negocio));
    }
}
