<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Negocios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiTemplate extends Controller
{

  # Vista única
  public function show($id)
  {
    $razon = Modelo::whereUuid($id)->first();

    return response()->json([
      'mensaje' => 'Recibido con éxito'
    ], 201);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'request' => 'required|string'
    ]);

    $crear = Modelo::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'razon' => $razon
    ], 201);
  }

  # Actualizar
  public function update(Request $request, $id)
  {
    $razon = Modelo::whereUuid($id)->first();

    $validacion = $request->validate([
      'request' => 'required|string'
    ]);

    $razon->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito',
      'razon' => $razon
    ], 201);
  }

  # Eliminar
  public function destroy(Request $request, $id)
  {
    $razon = Modelo::whereUuid($id)->first();

    $validacion = $request->validate([
      'request' => 'required|string'
    ]);

    $razon->destroy();

    return response()->json([
      'mensaje' => 'Eliminado con éxito',
      'razon' => $razon
    ], 201);
  }
}
