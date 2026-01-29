<?php

namespace App\Http\Controllers;

use App\Models\Negocios;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function negocio($id)
    {
        $negocio = Negocios::whereUuid($id)->first();
        return view('panel.single.negocio', compact('negocio'));
    }
}
