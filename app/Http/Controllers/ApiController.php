<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function test()
    {
        return 'hola';
    }
    public function evento_avisar(Request $request)
    {
        $evento = Evento::whereUuid($request->evento)->firstOrFail();

        $validacion = $request->validate([
            'titulo' => 'required|string|max:50',
            'cuerpo' => 'required|string|max:500'
        ]);

        return response()->json([
            'nombre' => $evento->nombre,
        ]);
    }
}
