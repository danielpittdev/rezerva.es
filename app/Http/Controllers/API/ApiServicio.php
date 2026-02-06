<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Negocios;
use App\Models\Suscripcion;
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
            'descripcion' => 'nullable|string',
            'precio' => 'required|string',
            'duracion' => 'nullable|string',
            'tipo' => 'required|string',
            'pago_online' => 'nullable|bool',
            'negocio_id' => 'uuid|exists:negocios,uuid',
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

        // Por defecto, pago_online es false
        $validated['pago_online'] = false;

        if ($request->pago_online) {
            // Verificar si el usuario tiene una suscripción activa con pago online
            $suscripcion = Suscripcion::where('user_id', Auth::id())
                ->where('stripe_status', 'active')
                ->first();

            if (!$suscripcion) {
                return response()->json([
                    'mensaje' => 'Necesitas una suscripción activa para habilitar pagos online',
                ], 422);
            }

            $planActivo = config("limites.{$suscripcion->type}.pago_online", false);

            if (!$planActivo) {
                return response()->json([
                    'mensaje' => 'Tu plan actual no incluye pagos online. Actualiza a Plus o Pro.',
                ], 422);
            }

            // Verificar que el negocio tenga cuenta Connect activa
            $negocio = $servicio->negocio;
            $tieneConnect = !empty($negocio->stripe_account_id);

            if (!$tieneConnect) {
                return response()->json([
                    'mensaje' => 'Debes conectar tu cuenta de Stripe antes de activar pagos online',
                    'connect_required' => true
                ], 422);
            }

            $precioEnCentimos = (int) ($validated['precio'] * 100);
            $precioCambio = $servicio->precio != $validated['precio'];
            $nombreCambio = $servicio->nombre != $validated['nombre'];
            $stripeAccountId = $negocio->stripe_account_id;

            try {
                $productId = $servicio->stripe_product_id;

                // Si no tiene producto, crear uno nuevo
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

                    $product = $this->stripe->products->create($productData, ['stripe_account' => $stripeAccountId]);

                    $productId = $product->id;
                    $validated['stripe_product_id'] = $productId;
                } elseif ($nombreCambio) {
                    // Actualizar nombre del producto si cambió
                    $updateData = ['name' => $validated['nombre']];
                    if (!empty($validated['descripcion'])) {
                        $updateData['description'] = $validated['descripcion'];
                    }
                    $this->stripe->products->update($productId, $updateData, ['stripe_account' => $stripeAccountId]);
                }

                // Crear nuevo precio si no existe o si cambió el precio
                if (empty($servicio->stripe_id) || $precioCambio) {
                    $price = $this->stripe->prices->create([
                        'currency' => strtolower($negocio->moneda),
                        'unit_amount' => $precioEnCentimos,
                        'product' => $productId,
                    ], ['stripe_account' => $stripeAccountId]);

                    $validated['stripe_id'] = $price->id;
                }

                $validated['pago_online'] = true;
            } catch (\Stripe\Exception\ApiErrorException $e) {
                \Log::error("Error en Stripe Connect: {$e->getMessage()}");
                return response()->json([
                    'mensaje' => 'Error al configurar el pago en Stripe: ' . $e->getMessage(),
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
        $servicio = Servicios::whereUuid($id)->first();
        if (!$servicio) return response()->json(['error' => 'Not found'], 404);

        // Archivar producto en Stripe si existe
        if ($servicio->stripe_product_id && $servicio->negocio->stripe_account_id) {
            try {
                $this->stripe->products->update(
                    $servicio->stripe_product_id,
                    ['active' => false],
                    ['stripe_account' => $servicio->negocio->stripe_account_id]
                );
            } catch (\Stripe\Exception\ApiErrorException $e) {
                \Log::warning("Error archivando producto en Stripe: {$e->getMessage()}");
            }
        }

        $servicio->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
