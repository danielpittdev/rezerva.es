<?php

namespace App\Http\Middleware;

use App\Models\Clientes;
use App\Models\Empleado;
use App\Models\Servicios;
use App\Models\Suscripcion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlanLimit
{
    /**
     * Recursos disponibles y cómo contar el uso actual de cada uno.
     */
    private function contarRecurso(mixed $user, string $recurso): int
    {
        return match ($recurso) {
            'negocios'  => $user->negocios()->count(),
            'clientes'  => Clientes::whereIn('negocio_id', $user->negocios()->pluck('id'))->count(),
            'empleados' => Empleado::whereIn('negocio_id', $user->negocios()->pluck('id'))->count(),
            'servicios' => Servicios::whereIn('negocio_id', $user->negocios()->pluck('id'))->count(),
            default     => 0,
        };
    }

    /**
     * Handle an incoming request.
     *
     * @param  string  $recurso  El recurso a verificar (negocios, clientes, empleados, servicios)
     */
    public function handle(Request $request, Closure $next, string $recurso): Response
    {
        // Solo comprobar límites al crear (POST), no al listar/ver/editar/eliminar
        if (!$request->isMethod('POST')) {
            return $next($request);
        }

        $user = $request->user();

        if (!$user) {
            return response()->json([
                'mensaje' => 'No autenticado.',
            ], 401);
        }

        // Buscar la suscripción activa del usuario
        $suscripcion = Suscripcion::where('user_id', $user->id)
            ->where('stripe_status', 'active')
            ->first();

        if (!$suscripcion) {
            $limites = config("limites.nonsus");
            $limite = $limites[$recurso] ?? 0;

            $usoActual = $this->contarRecurso($user, $recurso);

            if ($usoActual >= $limite) {
                return response()->json([
                    'mensaje' => "Has alcanzado el límite de {$limite} {$recurso}. Suscríbete para obtener más.",
                    'limite'  => $limite,
                    'actual'  => $usoActual,
                ], 403);
            }

            return $next($request);
        }

        $planSlug = $suscripcion->type;
        $limites = config("limites.{$planSlug}");

        if (!$limites) {
            return response()->json([
                'mensaje' => 'El plan actual no tiene límites configurados.',
            ], 403);
        }

        if (!isset($limites[$recurso])) {
            return response()->json([
                'mensaje' => "El recurso '{$recurso}' no tiene un límite definido para este plan.",
            ], 403);
        }

        $limite = $limites[$recurso];
        $usoActual = $this->contarRecurso($user, $recurso);

        if ($usoActual >= $limite) {
            return response()->json([
                'mensaje' => "Has alcanzado el límite de {$limite} {$recurso} para tu plan actual.",
                'limite'  => $limite,
                'actual'  => $usoActual,
            ], 403);
        }

        return $next($request);
    }
}
