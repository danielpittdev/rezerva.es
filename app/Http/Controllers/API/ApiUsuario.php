<?php

namespace App\Http\Controllers\API;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiUsuarios extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(Usuarios::all());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string|max:110',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8',
            'avatar' => 'required|string',
            'empresa_nombre' => 'required|string',
            'verificado' => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = Usuarios::create($validated);
        return response()->json($user, 201);
    }

    public function show($id): JsonResponse
    {
        $user = Usuarios::find($id);
        return $user ? response()->json($user) : response()->json(['error' => 'Not found'], 404);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = Usuarios::find($id);
        if (!$user) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'apellido' => 'sometimes|string|max:110',
            'email' => 'sometimes|email|unique:usuarios',
            'password' => 'sometimes|min:8',
            'avatar' => 'sometimes|string',
            'empresa_nombre' => 'sometimes|string',
            'verificado' => 'sometimes|string',
        ]);

        // Hashear la contraseña si se está actualizando
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        return response()->json($user);
    }

    public function destroy($id): JsonResponse
    {
        $user = Usuarios::find($id);
        if (!$user) return response()->json(['error' => 'Not found'], 404);

        $user->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
