<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validacion = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $usuario = Usuarios::where('email', $validacion['email'])->first();

        if (!$usuario || !Hash::check($validacion['password'], $usuario->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas'
            ], 401);
        }

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'mensaje' => 'Inicio correcto',
            'token' => $token
        ]);
    }

    public function registro(Request $request): JsonResponse
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:40',
            'apellido' => 'required|string|max:50',
            'nombre_empresa' => 'required|string|min:3',
            'password' => 'required|string|min:6',
            'email' => 'required|email|max:50|confirmed|unique:usuarios',
            'terminos_condiciones' => 'required',
        ]);

        # Registro
        $usuario = Usuarios::create([
            'nombre' => $validacion['nombre'],
            'apellido' => $validacion['apellido'],
            'nombre_empresa' => $validacion['nombre_empresa'],
            'password' => Hash::make($validacion['password']),
            'email' => $validacion['email'],
        ]);

        # Respuesta
        return response()->json([
            'mensaje' => 'Registro completo',
        ]);
    }
}
