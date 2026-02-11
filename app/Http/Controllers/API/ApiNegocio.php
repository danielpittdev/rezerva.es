<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Clientes;
use App\Models\Horarios;
use App\Models\Negocios;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\HorarioExcepcional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function show($id)
    {
        $negocio = Negocios::whereUuid($id)->first()->load('servicios');

        # Cargas
        $servicios = $negocio->servicios;
        $horarios_recurrentes = Horarios::where('negocio_id', $negocio->id)->get()->sortBy('id')->groupBy('dia');
        $horarios_puntuales = HorarioExcepcional::where('negocio_id', $negocio->id)->orderBy('fecha')->orderBy('franja_inicio')->get()->groupBy('fecha');;
        $clientes = Clientes::where('negocio_id', $negocio->id)->get();

        # Estadísticas de reservas
        $servicioIds = $servicios->pluck('id');

        // Total de reservas finalizadas
        $reservasFinalizadas = Reserva::whereIn('servicio_id', $servicioIds)
            ->where('estado', 'completado')
            ->count();

        // Reservas finalizadas este mes
        $reservasEsteMes = Reserva::whereIn('servicio_id', $servicioIds)
            ->where('estado', 'completado')
            ->whereMonth('fecha', Carbon::now()->month)
            ->whereYear('fecha', Carbon::now()->year)
            ->count();

        // Ingresos estimados de reservas finalizadas
        $ingresosEstimados = Reserva::whereIn('servicio_id', $servicioIds)
            ->where('estado', 'completado')
            ->with('servicio')
            ->get()
            ->sum(function ($reserva) {
                return $reserva->servicio->precio ?? 0;
            });

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
            'estadisticas' => [
                'reservas_finalizadas' => $reservasFinalizadas,
                'reservas_este_mes' => $reservasEsteMes,
                'ingresos_estimados' => number_format($ingresosEstimados, 2, ',', '.'),
            ],
        ], 201);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:otros,barbería,psicología,spa,clínica,gimnasio,consultoría',
            'moneda' => 'required|in:EUR,USD,COP,GBP',
            'online' => 'nullable',
            'postal_direccion' => 'required_without:online|string',
            'postal_codigo' => 'required_without:online|string',
            'postal_ciudad' => 'required_without:online|string',
            'postal_pais' => 'required_without:online|string',
            'info_email' => 'nullable|string',
            'info_telefono' => 'nullable|string',
        ]);

        $validated['usuario_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['nombre']);

        $negocio = Negocios::create($validated);
        return response()->json($negocio, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $negocio = Negocios::whereUuid($id)->first();
        if (!$negocio) return response()->json(['error' => 'Not found'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'descripcion' => 'sometimes|nullable|string',
            'tipo' => 'required|in:otros,barbería,psicología,spa,clínica,gimnasio,consultoría',
            'moneda' => 'required|in:EUR,USD,COP,GBP',
            'online' => 'nullable',
            'postal_direccion' => 'required_without:online|nullable|string',
            'postal_codigo' => 'required_without:online|nullable|string',
            'postal_ciudad' => 'required_without:online|nullable|string',
            'postal_pais' => 'required_without:online|nullable|string',
            'info_email' => 'nullable|string',
            'info_telefono' => 'nullable|string',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $validated['online'] = !empty($validated['online']);

        // Manejar subida de icono
        if ($request->hasFile('icono')) {
            // Eliminar icono anterior si existe
            if ($negocio->icono) {
                Storage::delete($negocio->icono);
            }

            $iconoPath = $request->file('icono')->store('negocios/iconos');
            $validated['icono'] = $iconoPath;
        }

        // Manejar subida de banner
        if ($request->hasFile('banner')) {
            // Eliminar banner anterior si existe
            if ($negocio->banner) {
                Storage::delete($negocio->banner);
            }

            $bannerPath = $request->file('banner')->store('negocios/banners');
            $validated['banner'] = $bannerPath;
        }

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
