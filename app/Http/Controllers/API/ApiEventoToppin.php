<?php

namespace App\Http\Controllers\API;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Models\EventoTopping;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiEventoToppin extends Controller
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

    if ($request->hasFile('icono')) {
      $validacion['icono'] = $request->file('icono')->store('eventos/toppings');
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
