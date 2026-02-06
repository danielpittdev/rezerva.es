<?php

namespace App\Http\Controllers\API;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Negocios;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Stripe\StripeClient;

class ApiFactura extends Controller
{

  # Vista única
  public function index(Request $request)
  {
    $negocios = Auth::user()->negocios;
    $facturas = $negocios->pluck('facturas')->flatten();

    // Reservas completadas SIN pago online
    $reservasCompletadas = $negocios->pluck('reservas')->flatten()
      ->where('estado', 'completado')
      ->where('pagado', '!=', true)
      ->sortByDesc('fecha');

    // Reservas con pago online (pagado = true)
    $pagosOnline = $negocios->pluck('reservas')->flatten()
      ->where('pagado', true)
      ->sortByDesc('fecha');

    $html = [];
    $resumen = $this->resumen();

    if ($request->lista) {
      $html['lista'] = view('components.listas.facturas.lista', compact('facturas'))->render();
      $html['reservas_completadas'] = view('components.listas.facturas.reservas_completadas', compact('reservasCompletadas'))->render();
      $html['pagos_online'] = view('components.listas.facturas.pagos_online', compact('pagosOnline'))->render();
    }

    // Obtener URL del dashboard de Stripe del primer negocio con Connect
    $stripeDashboardUrl = null;
    $negocioConConnect = $negocios->first(fn($n) => !empty($n->stripe_account_id));
    if ($negocioConConnect) {
      try {
        $stripe = new StripeClient(config('cashier.secret'));
        $loginLink = $stripe->accounts->createLoginLink($negocioConConnect->stripe_account_id);
        $stripeDashboardUrl = $loginLink->url;
      } catch (\Exception $e) {
        // Silenciar error si no se puede crear el link
      }
    }

    return response()->json([
      'mensaje' => 'Recibido con éxito',
      'factura' => $facturas,
      'reservas_completadas' => $reservasCompletadas->values(),
      'pagos_online' => $pagosOnline->values(),
      'pagos_online_count' => $pagosOnline->count(),
      'stripe_dashboard_url' => $stripeDashboardUrl,
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
