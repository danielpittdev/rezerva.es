<?php

namespace App\Http\Controllers\API;

use App\Models\Horarios;
use App\Models\Negocios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\HorarioExcepcional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiHorario extends Controller
{
    public function store(Request $request): JsonResponse
    {
        if ($request->tipo_horario === 'recurrente') {

            $validated = $request->validate([
                'dia' => 'required|array',
                'dia.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'franja_inicio' => 'required|date_format:H:i',
                'franja_final' => 'required|date_format:H:i',
                'negocio_id' => 'required|uuid|exists:negocios,uuid',
            ]);

            if ($validated['franja_inicio'] >= $validated['franja_final']) {
                return response()->json(['mensaje' => 'Hora final debe ser mayor'], 422);
            }

            $negocio = Negocios::whereUuid($validated['negocio_id'])->first();

            foreach ($validated['dia'] as $dia) {

                // 🔥 BORRAR SOLAPES
                Horarios::where('negocio_id', $negocio->id)
                    ->where('dia', $dia)
                    ->where(function ($q) use ($validated) {
                        $q->where('franja_inicio', '<', $validated['franja_final'])
                            ->where('franja_final', '>', $validated['franja_inicio']);
                    })
                    ->delete();

                // ➕ INSERTAR NUEVO
                Horarios::create([
                    'dia' => $dia,
                    'franja_inicio' => $validated['franja_inicio'],
                    'franja_final' => $validated['franja_final'],
                    'negocio_id' => $negocio->id,
                ]);
            }

            return response()->json(['mensaje' => 'Horario recurrente actualizado'], 201);
        }

        // 🔵 EXCEPCIONAL
        $validated = $request->validate([
            'fecha' => 'required|date',
            'franja_inicio' => 'nullable|date_format:H:i',
            'franja_final' => 'nullable|date_format:H:i',
            'cerrado' => 'sometimes|boolean',
            'negocio_id' => 'required|uuid|exists:negocios,uuid'
        ]);

        if (!empty($validated['franja_inicio']) && !empty($validated['franja_final'])) {
            if ($validated['franja_inicio'] >= $validated['franja_final']) {
                return response()->json(['mensaje' => 'Hora final debe ser mayor'], 422);
            }
        }

        $negocio = Negocios::whereUuid($validated['negocio_id'])->first();
        $validated['negocio_id'] = $negocio->id;

        // 🔥 BORRAR SOLAPES EN ESA FECHA
        HorarioExcepcional::where('negocio_id', $negocio->id)
            ->where('fecha', $validated['fecha'])
            ->where(function ($q) use ($validated) {
                $q->where('franja_inicio', '<', $validated['franja_final'])
                    ->where('franja_final', '>', $validated['franja_inicio']);
            })
            ->delete();

        HorarioExcepcional::create($validated);

        return response()->json(['mensaje' => 'Horario excepcional actualizado'], 201);
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        if ($request->franja_inicio >= $request->franja_final) {
            return response()->json(['mensaje' => 'Hora final debe ser mayor'], 422);
        }

        $horario = Horarios::whereUuid($uuid)->first();
        $excepcion = HorarioExcepcional::whereUuid($uuid)->first();

        if (!$horario && !$excepcion) {
            return response()->json(['mensaje' => 'Horario no encontrado'], 404);
        }

        // 🟢 HORARIO SEMANAL
        if ($horario) {
            $validated = $request->validate([
                'dia' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'franja_inicio' => 'required|date_format:H:i',
                'franja_final' => 'required|date_format:H:i',
            ]);

            $horario->update($validated);

            return response()->json($horario, 200);
        }

        // 🔵 EXCEPCIÓN
        $validated = $request->validate([
            'fecha' => 'required|date',
            'franja_inicio' => 'nullable|date_format:H:i',
            'franja_final' => 'nullable|date_format:H:i',
            'cerrado' => 'sometimes|boolean',
        ]);

        $excepcion->update($validated);

        return response()->json($excepcion, 200);
    }


    public function destroy($id): JsonResponse
    {
        $negocio = Horarios::whereUuid($id);
        if (!$negocio) return response()->json(['error' => 'Not found'], 404);

        $negocio->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
