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
            'old_password' => 'required_with:password|min:8',
            'password' => 'sometimes|confirmed|min:8',
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,png,gif|max:1024',
            'empresa_nombre' => 'sometimes|string',
            'verificado' => 'sometimes|string',
        ]);

        if (isset($validated['nombre'])) $validated['nombre'] = ucfirst($validated['nombre']);
        if (isset($validated['apellido'])) $validated['apellido'] = ucfirst($validated['apellido']);
        if (isset($validated['empresa_nombre'])) $validated['empresa_nombre'] = ucfirst($validated['empresa_nombre']);

        // Manejar cambio de contraseña
        if (isset($validated['old_password']) && isset($validated['password'])) {
            // Verificar que la contraseña antigua sea correcta
            if (!Hash::check($validated['old_password'], $user->password)) {
                return response()->json(['error' => 'La contraseña antigua es incorrecta'], 422);
            }
            // Hashear la nueva contraseña
            $validated['password'] = Hash::make($validated['password']);
            // Eliminar old_password del array de actualización
            unset($validated['old_password']);
        } else {
            // Si no se está cambiando la contraseña, eliminar estos campos
            unset($validated['old_password']);
            unset($validated['password']);
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
