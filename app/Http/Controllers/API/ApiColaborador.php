<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Colaboradores;
use App\Models\Negocios;
use App\Models\Usuarios;

class ApiColaborador extends Controller
{

  # Vista única
  public function show($id): JsonResponse
  {
    $colaborador = Colaboradores::whereUuid($id)->first();

    if (!$colaborador) {
      return response()->json(['error' => 'Colaborador no encontrado'], 404);
    }

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'colaborador' => $colaborador
    ], 200);
  }

  # Crear
  public function store(Request $request): JsonResponse
  {
    $validacion = $request->validate([
      'tipo' => 'required|in:acceso',
      'usuario_id' => 'required|uuid|exists:usuarios,uuid',
      'negocio_id' => 'required|uuid|exists:negocios,uuid',
    ]);

    $usuario = Usuarios::whereUuid($validacion['usuario_id'])->first();
    $negocio = Negocios::whereUuid($validacion['negocio_id'])->first();

    $colaborador = Colaboradores::create([
      'tipo' => $validacion['tipo'],
      'usuario_id' => $usuario->id,
      'negocio_id' => $negocio->id,
    ]);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'colaborador' => $colaborador
    ], 201);
  }

  # Eliminar
  public function destroy($id): JsonResponse
  {
    $colaborador = Colaboradores::whereUuid($id)->first();

    if (!$colaborador) {
      return response()->json(['error' => 'Colaborador no encontrado'], 404);
    }

    $colaborador->delete();

    return response()->json([
      'mensaje' => 'Eliminado con éxito'
    ], 200);
  }
}
