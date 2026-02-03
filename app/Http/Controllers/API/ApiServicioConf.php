<?php

namespace App\Http\Controllers\API;

use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Models\ServiciosConf;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiServicioConf extends Controller
{

  # Vista única
  public function show($id, Request $request)
  {
    $servicio = Servicios::whereUuid($id)->first();
    $vistas = [];

    // Mapeo de parámetros a vistas
    $vistasDisponibles = [
      'html' => ['key' => 'lista_preguntas', 'view' => 'components.listas.servicios.preguntas'],
      'lista2' => ['key' => 'lista_preguntas_2', 'view' => 'components.listas.servicios.preguntas'],
    ];

    // Solo cargar las vistas solicitadas
    foreach ($vistasDisponibles as $param => $config) {
      if ($request->has($param)) {
        $html = view($config['view'], compact('servicio'))->render();
        $vistas[$config['key']] = $html;
      }
    }

    return response()->json([
      'preguntas' => $servicio->preguntas,
      'html' => $vistas
    ], 201);
  }

  # Crear
  public function store(Request $request)
  {
    $validacion = $request->validate([
      'pregunta' => 'required|string',
      'obligatorio' => 'required|string',
      'tipo' => 'required|in:check,text,textarea,number',
      'servicio_id' => 'required|uuid',
    ]);

    $servicio = Servicios::whereUuid($validacion['servicio_id'])->first();
    $validacion['servicio_id'] = $servicio->id;

    $crear = ServiciosConf::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'razon' => $crear
    ], 201);
  }

  # Eliminar
  public function destroy($id)
  {
    $razon = ServiciosConf::whereUuid($id);
    $razon->delete();

    return response()->json([
      'mensaje' => 'Eliminado con éxito',
      'razon' => $razon
    ], 201);
  }
}
