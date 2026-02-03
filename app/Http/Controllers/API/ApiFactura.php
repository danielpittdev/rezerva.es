<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Negocios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiFactura extends Controller
{

  # Vista única
  public function index(Request $request)
  {
    $facturas = Auth::user()->negocios->pluck('facturas')->flatten();
    $html = [];
    $resumen = $this->resumen();

    if ($request->lista) {
      $html['lista'] = view('components.listas.facturas.lista', compact('facturas'))->render();
    }

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'factura' => $facturas,
      'html' => $html,
      'resumen' => $resumen->original
    ], 201);
  }

  # Resumen de facturación (diario, semanal, mensual)
  public function resumen()
  {
    $facturas = Auth::user()->negocios->pluck('facturas')->flatten();

    $inicioSemana = Carbon::now()->startOfWeek();
    $inicioMes = Carbon::now()->startOfMonth();

    $diario = $facturas->filter(fn($f) => Carbon::parse($f->created_at)->isToday())->sum('total');
    $semanal = $facturas->filter(fn($f) => Carbon::parse($f->created_at)->gte($inicioSemana))->sum('total');
    $mensual = $facturas->filter(fn($f) => Carbon::parse($f->created_at)->gte($inicioMes))->sum('total');

    return response()->json([
      'diario' => number_format($diario, 2, ',', '.'),
      'semanal' => number_format($semanal, 2, ',', '.'),
      'mensual' => number_format($mensual, 2, ',', '.'),
    ]);
  }
}
