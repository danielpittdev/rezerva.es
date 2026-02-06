<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Negocios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeConnectController extends Controller
{
    /**
     * Inicia el onboarding de Stripe Connect para un negocio
     */
    public function onboarding(Request $request, Negocios $negocio)
    {
        // Verificar que el usuario es dueño del negocio
        if ($negocio->usuario_id !== $request->user()->id) {
            abort(403, 'No tienes permiso para este negocio');
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        try {
            // Si ya tiene cuenta, solo generamos nuevo link
            if ($negocio->stripe_account_id) {
                $accountLink = $stripe->accountLinks->create([
                    'account' => $negocio->stripe_account_id,
                    'refresh_url' => route('stripe.connect.refresh', $negocio),
                    'return_url' => route('stripe.connect.callback', $negocio),
                    'type' => 'account_onboarding',
                ]);

                return response()->json(['redirect' => $accountLink->url]);
            }

            // Crear cuenta Express
            $account = $stripe->accounts->create([
                'type' => 'express',
                'country' => $this->getCountryCode($negocio->postal_pais),
                'email' => $negocio->info_email ?? $negocio->usuario->email,
                'capabilities' => [
                    'card_payments' => ['requested' => true],
                    'transfers' => ['requested' => true],
                ],
                'business_type' => 'individual',
                'metadata' => [
                    'negocio_id' => $negocio->id,
                    'negocio_uuid' => $negocio->uuid,
                ],
            ]);

            // Guardar el ID de la cuenta
            $negocio->update(['stripe_account_id' => $account->id]);

            // Crear link de onboarding
            $accountLink = $stripe->accountLinks->create([
                'account' => $account->id,
                'refresh_url' => route('stripe.connect.refresh', $negocio),
                'return_url' => route('stripe.connect.callback', $negocio),
                'type' => 'account_onboarding',
            ]);

            Log::info("Cuenta Connect creada para negocio: {$negocio->id}", [
                'stripe_account_id' => $account->id,
            ]);

            return response()->json(['redirect' => $accountLink->url]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error("Error creando cuenta Connect: {$e->getMessage()}");
            return response()->json(['error' => 'Error al conectar con Stripe'], 500);
        }
    }

    /**
     * Callback cuando el usuario vuelve del onboarding
     */
    public function callback(Request $request, Negocios $negocio)
    {
        if (!$negocio->stripe_account_id) {
            return redirect()->route('negocio', $negocio->uuid)
                ->with('error', 'No se encontró la cuenta de Stripe');
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        try {
            $account = $stripe->accounts->retrieve($negocio->stripe_account_id);

            if ($account->charges_enabled && $account->payouts_enabled) {
                return redirect()->route('negocio', $negocio->uuid)
                    ->with('success', 'Cuenta de Stripe conectada correctamente');
            }

            // Si no está completa, necesita más información
            return redirect()->route('negocio', $negocio->uuid)
                ->with('warning', 'Completa la configuración de tu cuenta de Stripe para recibir pagos');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error("Error verificando cuenta Connect: {$e->getMessage()}");
            return redirect()->route('negocio', $negocio->uuid)
                ->with('error', 'Error al verificar la cuenta de Stripe');
        }
    }

    /**
     * Refresh URL cuando el link expira
     */
    public function refresh(Request $request, Negocios $negocio)
    {
        return $this->onboarding($request, $negocio);
    }

    /**
     * Obtener el estado de la cuenta Connect
     */
    public function status(Request $request, Negocios $negocio)
    {
        if ($negocio->usuario_id !== $request->user()->id) {
            abort(403);
        }

        if (!$negocio->stripe_account_id) {
            return response()->json([
                'connected' => false,
                'charges_enabled' => false,
                'payouts_enabled' => false,
            ]);
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        try {
            $account = $stripe->accounts->retrieve($negocio->stripe_account_id);

            return response()->json([
                'connected' => true,
                'charges_enabled' => $account->charges_enabled,
                'payouts_enabled' => $account->payouts_enabled,
                'details_submitted' => $account->details_submitted,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'connected' => false,
                'error' => 'Error al obtener estado',
            ]);
        }
    }

    /**
     * Acceder al dashboard de Stripe Express
     */
    public function dashboard(Request $request, Negocios $negocio)
    {
        if ($negocio->usuario_id !== $request->user()->id) {
            abort(403);
        }

        if (!$negocio->stripe_account_id) {
            return response()->json(['error' => 'No hay cuenta conectada'], 400);
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        try {
            $loginLink = $stripe->accounts->createLoginLink($negocio->stripe_account_id);
            return response()->json(['redirect' => $loginLink->url]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error("Error creando login link: {$e->getMessage()}");
            return response()->json(['error' => 'Error al acceder al dashboard'], 500);
        }
    }

    /**
     * Desconectar cuenta de Stripe
     */
    public function disconnect(Request $request, Negocios $negocio)
    {
        if ($negocio->usuario_id !== $request->user()->id) {
            abort(403);
        }

        // No eliminamos la cuenta en Stripe, solo desvinculamos
        $negocio->update(['stripe_account_id' => null]);

        return response()->json(['success' => true]);
    }

    /**
     * Crear sesión de checkout para pago presencial (QR)
     */
    public function createPaymentCheckout(Request $request, \App\Models\Reserva $reserva)
    {
        $negocio = $reserva->servicio->negocio;

        // Verificar que el negocio tiene Stripe Connect activo
        if (!$negocio->stripe_account_id) {
            return response()->json(['error' => 'El negocio no tiene cuenta de Stripe conectada'], 400);
        }

        $stripe = new \Stripe\StripeClient(config('cashier.secret'));

        try {
            // Verificar que la cuenta puede recibir pagos
            $account = $stripe->accounts->retrieve($negocio->stripe_account_id);
            if (!$account->charges_enabled) {
                return response()->json(['error' => 'La cuenta de Stripe no está habilitada para pagos'], 400);
            }

            $precio = (int) ($reserva->servicio->precio * 100); // Convertir a centavos

            // Comisión de la plataforma (porcentaje configurable)
            $comisionPorcentaje = config('services.stripe.platform_fee_percent', 5); // 5% por defecto
            $applicationFee = (int) ($precio * ($comisionPorcentaje / 100));

            // Crear sesión de checkout con Stripe Connect
            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => $negocio->moneda ?? 'eur',
                        'product_data' => [
                            'name' => $reserva->servicio->nombre,
                            'description' => 'Reserva del ' . $reserva->fecha->format('d/m/Y H:i'),
                        ],
                        'unit_amount' => $precio,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'payment_intent_data' => [
                    'application_fee_amount' => $applicationFee,
                ],
                'success_url' => route('pago.success', ['reserva' => $reserva->uuid]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('pago.cancel', ['reserva' => $reserva->uuid]),
                'metadata' => [
                    'reserva_id' => $reserva->id,
                    'reserva_uuid' => $reserva->uuid,
                    'negocio_id' => $negocio->id,
                    'application_fee' => $applicationFee,
                ],
            ], [
                'stripe_account' => $negocio->stripe_account_id,
            ]);

            return response()->json([
                'checkout_url' => $session->url,
                'session_id' => $session->id,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            Log::error("Error creando checkout session: {$e->getMessage()}");
            return response()->json(['error' => 'Error al crear el enlace de pago'], 500);
        }
    }

    /**
     * Página de éxito después del pago
     */
    public function paymentSuccess(Request $request, Reserva $reserva)
    {
        $sessionId = $request->query('session_id');
        $negocio = $reserva->servicio->negocio;

        return redirect('https://rezerva.es/r/' . $reserva->uuid);
    }

    /**
     * Página de cancelación de pago
     */
    public function paymentCancel(\App\Models\Reserva $reserva)
    {
        return redirect('https://rezerva.es/r/' . $reserva->uuid);
    }

    /**
     * Convertir nombre de país a código ISO
     */
    private function getCountryCode(string $pais): string
    {
        $codes = [
            'España' => 'ES',
            'Spain' => 'ES',
            'Colombia' => 'CO',
            'México' => 'MX',
            'Mexico' => 'MX',
            'Estados Unidos' => 'US',
            'United States' => 'US',
            'Reino Unido' => 'GB',
            'United Kingdom' => 'GB',
        ];

        return $codes[$pais] ?? 'ES';
    }
}
