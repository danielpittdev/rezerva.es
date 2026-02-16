<?php

namespace App\Http\Middleware;

use App\Models\Suscripcion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSuscripcion
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $suscripcion = Suscripcion::where('user_id', $user->id)
            ->where('stripe_status', 'active')
            ->exists();

        if (!$suscripcion) {
            return redirect()->route('ajustes')->with('mensaje', 'Necesitas una suscripción activa para acceder a esta sección.');
        }

        return $next($request);
    }
}
