<?php

namespace App\Http\Controllers\API;

use App\Models\Negocios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiNegocio extends Controller
{

    public function index(): JsonResponse
    {
        $negocios = Auth::user()->negocios;
        $lista = view('components.listas.negocios.lista', compact('negocios'))->render();

        return response()->json([
            'negocios' => $negocios,
            'lista' => $lista
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'postal_direccion' => 'required|string',
            'postal_codigo' => 'required|string',
            'postal_ciudad' => 'required|string',
            'postal_pais' => 'required|string',
            'info_email' => 'nullable|string',
            'info_telefono' => 'nullable|string',
        ]);

        $validated['usuario_id'] = Auth::id();

        $negocio = Negocios::create($validated);
        return response()->json($negocio, 201);
    }

    public function show($id): JsonResponse
    {
        $negocio = Negocios::whereUuid($id)->first()->load('servicios');
        $servicios = $negocio->servicios;

        $lista_servicios = view('components.listas.servicios.lista', compact('servicios'))->render();

        return response()->json([
            'servicios' => $servicios,
            'lista_servicios' => $lista_servicios
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = Negocios::find($id);
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
        $user = Negocios::find($id);
        if (!$user) return response()->json(['error' => 'Not found'], 404);

        $user->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
