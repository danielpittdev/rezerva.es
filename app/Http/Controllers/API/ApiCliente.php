<?php

namespace App\Http\Controllers\API;

use App\Models\Clientes;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ApiCliente extends Controller
{
    public function index(): JsonResponse
    {
        $negocios = Auth::user()->negocios;
        $negocioIds = $negocios->pluck('id');

        $clientes = Clientes::whereIn('negocio_id', $negocioIds)
            ->with(['negocio', 'reservas'])
            ->orderBy('created_at', 'desc')
            ->get();

        $lista = view('components.listas.clientes.lista', compact('clientes'))->render();

        return response()->json([
            'clientes' => $clientes,
            'lista' => $lista
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'negocio_id' => 'required|string|exists:negocios,uuid',
        ]);

        // Convertir UUID del negocio a ID
        $negocio = \App\Models\Negocios::whereUuid($validated['negocio_id'])->first();
        $validated['negocio_id'] = $negocio->id;

        $cliente = Clientes::create($validated);
        return response()->json($cliente, 201);
    }

    public function show($id): JsonResponse
    {
        $cliente = Clientes::whereUuid($id)
            ->with(['negocio', 'reservas.servicio'])
            ->first();

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Estadísticas del cliente
        $reservasCompletadas = $cliente->reservas()->where('estado', 'completado')->count();
        $reservasPendientes = $cliente->reservas()->where('estado', 'pendiente')->count();
        $reservasCanceladas = $cliente->reservas()->where('estado', 'cancelado')->count();

        // Reservas este mes
        $reservasEsteMes = $cliente->reservas()
            ->where('estado', 'completado')
            ->whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->count();

        // Gasto total
        $gastoTotal = $cliente->reservas()
            ->where('estado', 'completado')
            ->with('servicio')
            ->get()
            ->sum(function ($reserva) {
                return $reserva->servicio->precio ?? 0;
            });

        // Última reserva
        $ultimaReserva = $cliente->reservas()
            ->with('servicio')
            ->orderBy('fecha', 'desc')
            ->first();

        // Historial de reservas (últimas 10)
        $reservas = $cliente->reservas()
            ->with('servicio')
            ->orderBy('fecha', 'desc')
            ->limit(10)
            ->get();

        $lista_reservas = view('components.listas.clientes.reservas', compact('reservas'))->render();

        // Datos para gráfica de reservas por mes (últimos 6 meses)
        $reservasPorMes = [];
        for ($i = 5; $i >= 0; $i--) {
            $fecha = Carbon::now()->subMonths($i);
            $count = $cliente->reservas()
                ->where('estado', 'completado')
                ->whereMonth('fecha', $fecha->month)
                ->whereYear('fecha', $fecha->year)
                ->count();

            $reservasPorMes[] = [
                'mes' => $fecha->format('M'),
                'count' => $count
            ];
        }

        return response()->json([
            'cliente' => $cliente,
            'estadisticas' => [
                'reservas_completadas' => $reservasCompletadas,
                'reservas_pendientes' => $reservasPendientes,
                'reservas_canceladas' => $reservasCanceladas,
                'reservas_este_mes' => $reservasEsteMes,
                'gasto_total' => number_format($gastoTotal, 2, ',', '.'),
                'ultima_reserva' => $ultimaReserva ? $ultimaReserva->fecha->format('d/m/Y') : 'Sin reservas',
            ],
            'grafica_reservas' => $reservasPorMes,
            'lista_reservas' => $lista_reservas,
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $cliente = Clientes::whereUuid($id)->first();
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'apellido' => 'sometimes|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'required_without:email|string|max:20',
        ]);

        $cliente->update($validated);
        return response()->json($cliente);
    }

    public function destroy($id): JsonResponse
    {
        $cliente = Clientes::whereUuid($id)->first();
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }
}
