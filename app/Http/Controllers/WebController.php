<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function registro()
    {
        return view('registro');
    }

    public function recuperar()
    {
        return view('recuperar');
    }

    public function resetear($id)
    {
        return view('resetear');
    }
}
