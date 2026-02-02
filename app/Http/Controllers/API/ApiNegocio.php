<?php

namespace App\Http\Controllers\API;

use App\Models\Clientes;
use App\Models\Horarios;
use App\Models\Negocios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\HorarioExcepcional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiNegocio extends Controller
{

    public function index(): JsonResponse
    {
        $negocios = Auth::user()->negocios;
        $lista = view('components.listas.negocios.lista', compact('negocios'))->render();

        return response()->json([
            'negocios' => $negocios,
            'lista' => $lista
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'postal_direccion' => 'required|string',
            'postal_codigo' => 'required|string',
            'postal_ciudad' => 'required|string',
            'postal_pais' => 'required|string',
            'info_email' => 'nullable|string',
            'info_telefono' => 'nullable|string',
        ]);

        $validated['usuario_id'] = Auth::id();

        $negocio = Negocios::create($validated);
        return response()->json($negocio, 201);
    }

    public function show($id)
    {
        $negocio = Negocios::whereUuid($id)->first()->load('servicios');

        # Cargas
        $servicios = $negocio->servicios;
        $horarios_recurrentes = Horarios::where('negocio_id', $negocio->id)->get()->sortBy('id')->groupBy('dia');
        $horarios_puntuales = HorarioExcepcional::where('negocio_id', $negocio->id)->orderBy('fecha')->orderBy('franja_inicio')->get()->groupBy('fecha');;
        $clientes = Clientes::where('negocio_id', $negocio->id)->get();

        $lista_servicios = view('components.listas.servicios.lista', compact('servicios'))->render();
        $lista_servicios_select = view('components.listas.negocios.servicios', compact('servicios'))->render();
        $lista_horario_recurrente = view('components.listas.horarios.recurrente', compact('horarios_recurrentes'))->render();
        $lista_horario_puntual = view('components.listas.horarios.puntual', compact('horarios_puntuales'))->render();
        $lita_clientes = view('components.listas.clientes.habituales', compact('clientes'))->render();

        return response()->json([
            'servicios' => $servicios,
            'lista_servicios' => $lista_servicios,
            'lista_servicios_select' => $lista_servicios_select,
            'lista_horario_recurrente' => $lista_horario_recurrente,
            'lista_horario_puntual' => $lista_horario_puntual,
            'lita_clientes' => $lita_clientes,
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $negocio = Negocios::whereUuid($id);
        if (!$negocio) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'descripcion' => 'sometimes|string',
            'tipo' => 'sometimes|string',
            'postal_direccion' => 'sometimes|string',
            'postal_codigo' => 'sometimes|string',
            'postal_ciudad' => 'sometimes|string',
            'postal_pais' => 'sometimes|string',
            'info_email' => 'nullable|string',
            'info_telefono' => 'nullable|string',
        ]);

        $negocio->update($validated);
        return response()->json($negocio);
    }

    public function destroy($id): JsonResponse
    {
        $negocio = Negocios::find($id);
        if (!$negocio) return response()->json(['error' => 'Not found'], 404);

        $negocio->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
