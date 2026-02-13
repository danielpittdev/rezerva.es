<?php

namespace App\Http\Controllers\API;

use App\Models\Evento;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use App\Models\EventoTopping;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiEventoTopping extends Controller
{

  # Vista única
  public function show($id, Request $request)
  {
    $evento = Evento::whereUuid($id)->first();
    $vistas = [];

    $vistasDisponibles = [
      'html' => ['key' => 'lista_toppings', 'view' => 'components.listas.eventos.toppings'],
    ];

    foreach ($vistasDisponibles as $param => $config) {
      if ($request->has($param)) {
        $html = view($config['view'], compact('evento'))->render();
        $vistas[$config['key']] = $html;
      }
    }

    return response()->json([
      'toppings' => $evento->toppings,
      'html' => $vistas
    ], 201);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'nombre' => 'required|string',
      'descripcion' => 'required|string',
      'icono' => 'nullable|image',
      'precio' => 'required|numeric|min:0',
      'evento_id' => 'required|uuid',
    ]);

    $evento = Evento::whereUuid($validacion['evento_id'])->first();
    $validacion['evento_id'] = $evento->id;

    $usuario = $request->user();

    $suscripcion = Suscripcion::where('user_id', $usuario->id)
      ->where('stripe_status', 'active')
      ->first();

    if (!$suscripcion || config("limites.{$suscripcion->type}.evento_toppings" < $evento->toppings->count())) {
      return response()->json([
        'mensaje' => ['Has superado el límite de toppings para este evento. Actualiza a un plan superior para añadir más.']
      ], 401);
    }

    if ($request->hasFile('icono')) {
      $validacion['icono'] = $request->file('icono')->store('eventos/toppings');
    }

    if ($evento->negocio->stripeAccountActivo()) {
      $stripe = new \Stripe\StripeClient(config('cashier.secret'));
      $stripeProduct = $stripe->products->create([
        'name' => $validacion['nombre'],
        'description' => $validacion['descripcion'],
      ], ['stripe_account' => $evento->negocio->stripe_account_id]);

      $stripePrice = $stripe->prices->create([
        'unit_amount' => $validacion['precio'] * 100,
        'currency' => 'eur',
        'product' => $stripeProduct->id,
      ], ['stripe_account' => $evento->negocio->stripe_account_id]);

      $validacion['stripe_price'] = $stripePrice->id;
    }

    $crear = EventoTopping::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'razon' => $crear
    ], 201);
  }

  # Actualizar
  public function update($id, Request $request)
  {
    $validacion = $request->validate([
      'nombre' => 'sometimes|string',
      'descripcion' => 'required|string',
      'icono' => 'nullable|image',
      'precio' => 'sometimes|numeric|min:0',
    ]);

    $topping = EventoTopping::whereUuid($id)->first();

    if ($request->hasFile('icono')) {
      if ($topping->icono) {
        Storage::delete($topping->icono);
      }
      $validacion['icono'] = $request->file('icono')->store('eventos/toppings');
    }

    $topping->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito',
      'razon' => $topping
    ], 201);
  }

  # Eliminar
  public function destroy($id)
  {
    $razon = EventoTopping::whereUuid($id);
    $razon->delete();

    return response()->json([
      'mensaje' => 'Eliminado con éxito',
      'razon' => $razon
    ], 201);
  }
}
