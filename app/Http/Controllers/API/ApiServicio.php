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
use Stripe\Price;

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
            'descripcion' => 'null|string',
            'precio' => 'required|string',
            'duracion' => 'nullable|string',
            'tipo' => 'required|string',
            'pago_online' => 'nullable|bool',
            'icono' => 'nullable|string',
            'color' => 'nullable|in:blue,green,yellow,red,purple,pink,indigo,orange,black',
            'negocio_id' => 'uuid',
        ]);

        $negocio =  Negocios::whereUuid($validated['negocio_id'])->first();
        $validated['negocio_id'] = $negocio->id;

        $validated['nombre'] = $validated['nombre'];
        $validated['descripcion'] = $validated['descripcion'] ?? null;

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
            'nota_rapida' => 'nullable',
            'icono' => 'nullable|string',
            'color' => 'nullable|in:blue,green,yellow,red,purple,pink,indigo,orange,black',
            'negocio_id' => 'uuid',
        ]);

        $validated['nombre'] = $validated['nombre'];
        $validated['descripcion'] = $validated['descripcion'] ?? null;

        if ($request->pago_online) {
            $validated['pago_online'] = true;
            Stripe::setApiKey(config('cashier.secret'));

            $precioEnCentimos = (int) ($validated['precio'] * 100);
            $precioCambio = $servicio->precio != $validated['precio'];

            // Crear precio en Stripe si no existe o si el precio ha cambiado
            if (empty($servicio->stripe_id) || $precioCambio) {
                $price = Price::create([
                    'currency' => 'eur',
                    'unit_amount' => $precioEnCentimos,
                    'product_data' => [
                        'name' => $validated['nombre'],
                        'metadata' => [
                            'servicio_uuid' => $servicio->uuid,
                            'negocio_id' => $servicio->negocio_id,
                        ],
                    ],
                ]);

                $validated['stripe_id'] = $price->id;
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
