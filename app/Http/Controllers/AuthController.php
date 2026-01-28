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
}
