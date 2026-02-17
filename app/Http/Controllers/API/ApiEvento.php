<?php

namespace App\Http\Controllers\API;

use App\Models\Evento;
use App\Models\Negocios;
use Stripe\StripeClient;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiEvento extends Controller
{
  private StripeClient $stripe;

  public function __construct()
  {
    $this->stripe = new StripeClient(config('cashier.secret'));
  }

  # Vista única
  public function show($id)
  {
    $evento = Evento::whereUuid($id)->first();
    $reservas = $evento->reservas->sortByDesc('id');
    $datos = [
      'cont_clientes' => $reservas->count(),
      'cont_localidades' => $reservas->sum('cantidad'),
      'cont_ingresos_estimados' => number_format($reservas->sum('total'), 2, ',', '.'),
    ];
    $toppings = $evento->toppings;

    $listas = [
      'reservas' => view('components.listas.eventos.reservas', compact('reservas'))->render(),
      'toppings' => view('components.listas.eventos.toppings', compact('toppings'))->render(),
    ];

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'datos' => $datos,
      'listas' => $listas
    ], 201);
  }

  # Vista potenciada
  public function index(Request $request)
  {
    $eventos = Auth::user()->negocios->pluck('eventos')->flatten();

    $listas = [
      'lista' => view('components.listas.eventos.lista', compact('eventos'))->render()
    ];

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'eventos' => $eventos,
      'listas' => $listas
    ], 201);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'nombre' => 'required|string|max:50',
      'descripcion' => 'required|string|max:300',
      'lugar' => 'required|string|max:200',
      'fecha' => 'required|date_format:Y-m-d\TH:i',
      'stock' => 'nullable|integer',
      'precio' => 'sometimes|numeric|min:0|decimal:0,2',
      'negocio_id' => 'required|uuid|exists:negocios,uuid',
    ]);

    $negocio = Negocios::whereUuid($validacion['negocio_id'])->firstOrFail();

    # Configuración adicional
    $validacion['nombre'] = ucfirst($validacion['nombre']);
    $validacion['descripcion'] = ucfirst($validacion['descripcion']);
    $validacion['lugar'] = ucfirst($validacion['lugar']);
    $validacion['negocio_id'] = $negocio->id;

    $evento = Evento::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'evento' => $evento
    ], 201);
  }

  # Actualizar
  public function update(Request $request, $id)
  {
    $evento = Evento::whereUuid($id)->first();

    $validacion = $request->validate([
      'nombre' => 'sometimes|string|max:50',
      'descripcion' => 'sometimes|string|max:300',
      'lugar' => 'sometimes|string|max:200',
      'fecha' => 'required|date_format:Y-m-d\TH:i',
      'stock' => 'sometimes|integer',
      'precio' => 'sometimes|numeric|min:0|decimal:0,2',
      'max_compra' => 'sometimes|numeric|min:1',
      'pago_online' => 'nullable',
      'pago_efectivo' => 'nullable',
    ]);

    # Configuración adicional
    $validacion['nombre'] = ucfirst($validacion['nombre']);
    $validacion['descripcion'] = ucfirst($validacion['descripcion']);
    $validacion['lugar'] = ucfirst($validacion['lugar']);
    $validacion['pago_efectivo'] = $request->pago_efectivo ?? false;
    $validacion['pago_online'] = false;

    if ($request->pago_online) {
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

      $negocio = $evento->negocio;

      if (empty($negocio->stripe_account_id)) {
        return response()->json([
          'mensaje' => 'Debes conectar tu cuenta de Stripe antes de activar pagos online',
          'connect_required' => true
        ], 422);
      }

      $precioEnCentimos = (int) (($validacion['precio'] ?? $evento->precio) * 100);
      $precioCambio = $evento->precio != ($validacion['precio'] ?? $evento->precio);
      $stripeAccountId = $negocio->stripe_account_id;

      try {
        if (empty($evento->stripe_price) || $precioCambio) {
          $price = $this->stripe->prices->create([
            'currency' => strtolower($negocio->moneda),
            'unit_amount' => $precioEnCentimos,
            'product_data' => [
              'name' => $validacion['nombre'],
              'metadata' => [
                'evento_uuid' => $evento->uuid,
                'negocio_id' => $evento->negocio_id,
              ],
            ],
          ], ['stripe_account' => $stripeAccountId]);

          $validacion['stripe_price'] = $price->id;
        }

        $validacion['pago_online'] = true;
      } catch (\Stripe\Exception\ApiErrorException $e) {
        Log::error("Error en Stripe Connect (Evento): {$e->getMessage()}");
        return response()->json([
          'mensaje' => 'Error al configurar el pago en Stripe: ' . $e->getMessage(),
        ], 500);
      }
    }

    $evento->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito iaaii',
      'evento' => $evento
    ], 201);
  }

  # Eliminar
  public function destroy(Request $request, $id)
  {
    $evento = Evento::whereUuid($id)->first();
    $evento->destroy();

    return response()->json([
      'mensaje' => 'Eliminado con éxito',
      'evento' => $evento
    ], 201);
  }
}
