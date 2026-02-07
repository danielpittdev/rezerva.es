<?php

namespace App\Http\Controllers\API;

use App\Models\Evento;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiEvento extends Controller
{

  # Vista única
  public function show($id)
  {
    $evento = Evento::whereUuid($id)->first();

    return response()->json([
      'mensaje' => 'Recibido con éxito'
    ], 201);
  }

  # Vista potenciada
  public function index()
  {
    $eventos = Auth::user()->negocios->pluck('eventos')->flatten();

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'eventos' => $eventos,
    ], 201);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'nombre' => 'required|string|max:50',
      'descripcion' => 'required|string|max:300',
      'lugar' => 'required|string|max:200',
      'stock' => 'nullable|integer',
      'precio' => 'required|integer|min:0',
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
      'stock' => 'sometimes|integer',
      'precio' => 'sometimes|integer|min:0',
      'negocio_id' => 'sometimes|uuid|exists:negocios,uuid',
    ]);

    # Configuración adicional
    $validacion['nombre'] = strtoupper($validacion['nombre']);
    $validacion['descripcion'] = strtoupper($validacion['descripcion']);
    $validacion['lugar'] = strtoupper($validacion['lugar']);

    $evento->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito',
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
