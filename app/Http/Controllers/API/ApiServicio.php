<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Negocios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\StripeClient;

class ApiServicio extends Controller
{
    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

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

        $validated['pago_online'] = false;

        if ($request->pago_online) {
            $negocio = $servicio->negocio;

            // Verificar que el negocio tenga cuenta Connect
            if (empty($negocio->stripe_account_id)) {
                return response()->json([
                    'mensaje' => 'El negocio debe conectar su cuenta de Stripe primero',
                ], 422);
            }

            $stripeAccountId = $negocio->stripe_account_id;
            $precioEnCentimos = (int) ($validated['precio'] * 100);
            $precioCambio = $servicio->precio != $validated['precio'];

            try {
                $productId = $servicio->stripe_product_id;

                // Crear producto si no existe
                if (empty($productId)) {
                    $productData = [
                        'name' => $validated['nombre'],
                        'metadata' => [
                            'servicio_uuid' => $servicio->uuid,
                            'negocio_id' => $servicio->negocio_id,
                        ],
                    ];
                    if (!empty($validated['descripcion'])) {
                        $productData['description'] = $validated['descripcion'];
                    }

                    $product = $this->stripe->products->create($productData, [
                        'stripe_account' => $stripeAccountId
                    ]);

                    $productId = $product->id;
                    $validated['stripe_product_id'] = $productId;
                }

                // Crear precio si no existe o si cambió el precio
                if (empty($servicio->stripe_id) || $precioCambio) {
                    $price = $this->stripe->prices->create([
                        'currency' => 'eur',
                        'unit_amount' => $precioEnCentimos,
                        'product' => $productId,
                    ], ['stripe_account' => $stripeAccountId]);

                    $validated['stripe_id'] = $price->id;
                }

                $validated['pago_online'] = true;

            } catch (\Stripe\Exception\ApiErrorException $e) {
                \Log::error("Error en Stripe Connect: {$e->getMessage()}");
                return response()->json([
                    'mensaje' => 'Error al configurar Stripe: ' . $e->getMessage(),
                ], 500);
            }
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
