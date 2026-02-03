<?php

namespace App\Http\Controllers\API;

use App\Models\Reserva;
use App\Models\Empleado;
use App\Models\Negocios;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiEmpleado extends Controller
{
  # Listar empleados
  public function index(): JsonResponse
  {
    $negocios = Auth::user()->negocios->pluck('id');
    $empleados = Empleado::whereIn('negocio_id', $negocios)->get();
    $lista = view('components.listas.empleados.lista', compact('empleados'))->render();

    return response()->json([
      'empleados' => $empleados,
      'lista' => $lista
    ]);
  }

  # Vista única
  public function show($id): JsonResponse
  {
    $empleado = Empleado::whereUuid($id)->first();

    if (!$empleado) {
      return response()->json(['error' => 'Empleado no encontrado'], 404);
    }

    // Estadísticas de reservas del empleado
    $reservasFinalizadas = Reserva::where('empleado_id', $empleado->id)
      ->where('estado', 'completado')
      ->count();

    $reservasEsteMes = Reserva::where('empleado_id', $empleado->id)
      ->where('estado', 'completado')
      ->whereMonth('fecha', Carbon::now()->month)
      ->whereYear('fecha', Carbon::now()->year)
      ->count();

    $reservasPendientes = Reserva::where('empleado_id', $empleado->id)
      ->where('estado', 'pendiente')
      ->count();

    $ingresosEstimados = Reserva::where('empleado_id', $empleado->id)
      ->where('estado', 'completado')
      ->with('servicio')
      ->get()
      ->sum(function ($reserva) {
        return $reserva->servicio->precio ?? 0;
      });

    // Últimas reservas del empleado
    $ultimasReservas = Reserva::where('empleado_id', $empleado->id)
      ->with(['servicio', 'cliente'])
      ->orderBy('fecha', 'desc')
      ->limit(10)
      ->get();

    $lista_reservas = view('components.listas.empleados.reservas', compact('ultimasReservas'))->render();

    return response()->json([
      'empleado' => $empleado,
      'lista_reservas' => $lista_reservas,
      'estadisticas' => [
        'reservas_finalizadas' => $reservasFinalizadas,
        'reservas_este_mes' => $reservasEsteMes,
        'reservas_pendientes' => $reservasPendientes,
        'ingresos_estimados' => number_format($ingresosEstimados, 2, ',', '.'),
      ],
    ], 200);
  }

  # Crear
  public function store(Request $request): JsonResponse
  {
    $validacion = $request->validate([
      'nombre' => 'required|string|max:50',
      'apellido' => 'required|string|max:100',
      'email' => 'nullable|email|unique:empleados,email',
      'telefono' => 'required_without:email|string',
      'tipo' => 'required|in:empleado,colaborador,administrador',
      'estado' => 'required|in:activo,inactivo',
      'negocio_id' => 'nullable|exists:negocios,uuid',
    ]);

    # MAYU
    $validacion['nombre'] = ucfirst($validacion['nombre']);
    $validacion['apellido'] = ucfirst($validacion['apellido']);

    # Si se proporciona negocio_id como UUID, convertir a ID
    if (isset($validacion['negocio_id'])) {
      $negocio = Negocios::whereUuid($validacion['negocio_id'])->first();
      $validacion['negocio_id'] = $negocio ? $negocio->id : null;
    } else {
      # Asignar al primer negocio del usuario si no se especifica
      $primerNegocio = Auth::user()->negocios->first();
      $validacion['negocio_id'] = $primerNegocio ? $primerNegocio->id : null;
    }

    $empleado = Empleado::create($validacion);

    return response()->json([
      'mensaje' => 'Creado con éxito',
      'razon' => $empleado
    ], 201);
  }

  # Actualizar
  public function update(Request $request, $id): JsonResponse
  {
    $empleado = Empleado::whereUuid($id)->first();

    if (!$empleado) {
      return response()->json(['error' => 'Empleado no encontrado'], 404);
    }

    $validacion = $request->validate([
      'nombre' => 'sometimes|string|max:50',
      'apellido' => 'sometimes|string|max:100',
      'email' => 'nullable|email|unique:empleados,email,' . $empleado->id,
      'telefono' => 'nullable|string',
      'tipo' => 'sometimes|in:empleado,colaborador,administrador',
      'estado' => 'sometimes|in:activo,inactivo',
    ]);

    # MAYU
    if (isset($validacion['nombre'])) {
      $validacion['nombre'] = ucfirst($validacion['nombre']);
    }
    if (isset($validacion['apellido'])) {
      $validacion['apellido'] = ucfirst($validacion['apellido']);
    }

    $empleado->update($validacion);

    return response()->json([
      'mensaje' => 'Actualizado con éxito',
      'empleado' => $empleado
    ], 200);
  }

  # Eliminar
  public function destroy(Request $request, $id): JsonResponse
  {
    $empleado = Empleado::whereUuid($id)->first();

    if (!$empleado) {
      return response()->json(['error' => 'Empleado no encontrado'], 404);
    }

    $empleado->delete();

    return response()->json([
      'mensaje' => 'Eliminado con éxito'
    ], 200);
  }
}
