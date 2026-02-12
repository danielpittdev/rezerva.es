<?php

namespace App\Http\Controllers\API;

use App\Models\Evento;
use GuzzleHttp\Client;
use App\Models\Clientes;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\ReservaEvento;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiEventoReserva extends Controller
{

  # Vista única
  public function show($id)
  {
    $reserva = ReservaEvento::whereUuid($id)->with('cliente', 'evento.negocio')->first();
    $relacionados = $reserva->relacionados();

    $modal = view('components.modal.evento.detalles', compact('reserva', 'relacionados'))->render();

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'reserva' => $reserva,
      'negocio_id' => $reserva->evento->negocio->id,
      'modal' => $modal,
    ], 200);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'pagado' => 'nullable|boolean',
      'confirmacion' => 'nullable|boolean',
      'metodo_pago' => 'required|in:tarjeta,efectivo,presencial,bizum',
      'pagado' => 'nullable',
      'cantidad' => 'integer|string',
      'evento_id' => 'required|uuid|exists:eventos,uuid',
      //
      'cliente_nombre' => 'required|string',
      'cliente_apellido' => 'required|string',
      'cliente_email' => 'nullable|email',
      'cliente_telefono' => 'required_without:cliente_email',
    ]);

    $cliente = Clientes::where('email', $request->cliente_email)->first();
    $evento = Evento::whereUuid($request->evento_id)->first();
    $negocio = Auth::user()->negocios[0];

    if ($validacion['cantidad'] > $evento->stock) {
      return response()->json([
        'errors' => ['cantidad' => ['No hay stock suficiente']]
      ], 403);
    }

    if (isset($validacion['pagado'])) {
      $validacion['pagado'] = true;
    }

    if (!$cliente) {
      $cliente = Clientes::create([
        'nombre' => $validacion['cliente_nombre'],
        'apellido' => $validacion['cliente_apellido'],
        'email' => $validacion['cliente_email'],
        'telefono' => $validacion['cliente_telefono'],
        'negocio_id' => $negocio->id,
      ]);
    }

    $evento->stock -= $validacion['cantidad'];
    $evento->save();

    $validacion['cliente_id'] = $cliente->id;
    $validacion['evento_id'] = $evento->id;
    $validacion['total'] = $evento->precio * $validacion['cantidad'];

    $reserva = ReservaEvento::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'reserva' => $reserva
    ], 201);
  }

  # Actualizar
  public function update(Request $request, $id)
  {
    $reserva = ReservaEvento::whereUuid($id)->first();

    $validacion = $request->validate([
      'request' => 'required|string'
    ]);

    $reserva->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito',
      'reserva' => $reserva
    ], 201);
  }

  # Eliminar
  public function destroy(Request $request, $id)
  {
    $reserva = ReservaEvento::whereUuid($id)->first();

    $validacion = $request->validate([
      'request' => 'required|string'
    ]);

    $reserva->destroy();

    return response()->json([
      'mensaje' => 'Eliminado con éxito',
      'reserva' => $reserva
    ], 201);
  }
}
