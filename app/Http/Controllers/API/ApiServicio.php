<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Negocios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\Stripe;
use Stripe\Product;

class ApiServicio extends Controller
{

    public function index(): JsonResponse
    {
        $servicios = Auth::user()->negocios->load('servicios')->flatMap->servicios;
        $lista = view('components.listas.servicios.lista_grande', compact('servicios'))->render();

        return response()->json([
            'servicios' => $servicios,
            'lista' => $lista
        ]);
    }

    public function show($id): JsonResponse
    {
        $negocio = Servicios::whereUuid($id)->first()->load('servicios');
        $servicios = $negocio->servicios;

        $lista_servicios = view('components.listas.servicios.lista', compact('servicios'))->render();

        return response()->json([
            'servicios' => $servicios,
            'lista_servicios' => $lista_servicios
        ], 201);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|string',
            'duracion' => 'nullable|string',
            'tipo' => 'required|string',
            'pago_online' => 'nullable|bool',
            'icono' => 'nullable|string',
            'negocio_id' => 'uuid',
        ]);

        $negocio =  Negocios::whereUuid($validated['negocio_id'])->first();
        $validated['negocio_id'] = $negocio->id;

        $servicio = Servicios::create($validated);
        return response()->json($servicio, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $servicio = Servicios::whereUuid($id)->first();
        if (!$servicio) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|string',
            'duracion' => 'nullable|string',
            'tipo' => 'nullable|string',
            'pago_online' => 'nullable',
            'icono' => 'nullable|string',
            'negocio_id' => 'uuid',
        ]);

        if ($request->pago_online) {
            $validated['pago_online'] = true;

            // Crear producto en Stripe solo si se activa pago_online por primera vez
            if (empty($servicio->stripe_id)) {
                Stripe::setApiKey(config('cashier.secret'));

                $producto = Product::create([
                    'name' => $validated['nombre'],
                    'description' => $validated['descripcion'] ?? null,
                    'metadata' => [
                        'servicio_uuid' => $servicio->uuid,
                        'negocio_id' => $servicio->negocio_id,
                    ],
                ]);

                $validated['stripe_id'] = $producto->id;
            }
        } else {
            $validated['pago_online'] = false;
        }

        // Hashear la contraseña si se está actualizando
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $servicio->update($validated);
        return response()->json($servicio);
    }

    public function destroy($id): JsonResponse
    {
        $servicio = Servicios::whereUuid($id);
        if (!$servicio) return response()->json(['error' => 'Not found'], 404);

        $servicio->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
