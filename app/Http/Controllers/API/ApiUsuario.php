<?php

namespace App\Http\Controllers\API;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApiUsuario extends Controller
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
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'empresa_nombre' => 'required|string',
            'verificado' => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('usuarios/avatars', 'public');
        }

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
        $user = Usuarios::whereUuid($id)->first();
        if (!$user) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'apellido' => 'sometimes|string|max:110',
            'email' => 'sometimes|email',
            'password' => 'sometimes|min:8',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,png,gif|max:1024',
            'empresa_nombre' => 'sometimes|string',
            'verificado' => 'sometimes|string',
        ]);

        if (isset($validated['nombre'])) $validated['nombre'] = ucfirst($validated['nombre']);
        if (isset($validated['apellido'])) $validated['apellido'] = ucfirst($validated['apellido']);
        if (isset($validated['empresa_nombre'])) $validated['empresa_nombre'] = ucfirst($validated['empresa_nombre']);

        // Hashear la contraseña si se está actualizando
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Manejar subida de avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('usuarios/avatars', 'public');
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
