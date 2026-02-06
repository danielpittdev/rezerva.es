<?php

namespace App\Listeners;

use App\Models\Factura;
use App\Models\Clientes;
use App\Models\Usuarios;
use App\Models\Negocios;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class WebhookController
{
    public function handle(WebhookReceived $event): void
    {
        $type = $event->payload['type'];
        $data = $event->payload['data']['object'];

        Log::info("Webhook recibido: {$type}", ['stripe_id' => $data['id'] ?? null]);

        // ─── Checkout ───────────────────────────────────────────
        if ($type === 'checkout.session.completed') {
            // Se completa el checkout de Stripe (primera suscripción o pago único)
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Checkout completado para usuario: {$usuario->id}");
                // TODO: Activar funcionalidades del plan, enviar email de bienvenida, etc.
            }
        }

        // ─── Pagos ──────────────────────────────────────────────
        if ($type === 'invoice.payment_succeeded') {
            // Pago exitoso (renovación o primer pago)
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {

                // Lógica

                // TODO: Enviar factura por email, registrar pago en historial, etc.
            }
        }

        if ($type === 'invoice.payment_failed') {
            // Pago fallido (tarjeta rechazada, fondos insuficientes, etc.)
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::warning("Pago fallido para usuario: {$usuario->id}", [
                    'invoice_id' => $data['id'],
                    'attempt_count' => $data['attempt_count'] ?? null,
                ]);
                // TODO: Notificar al usuario, mostrar aviso en el panel, etc.
            }
        }

        // ─── Suscripciones ──────────────────────────────────────
        if ($type === 'customer.subscription.created') {
            // Nueva suscripción creada
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Suscripción creada para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                    'status' => $data['status'],
                ]);
                // TODO: Activar acceso al plan, registrar en logs, etc.
            }
        }

        if ($type === 'customer.subscription.updated') {
            // Suscripción actualizada (cambio de plan, de precio, de cantidad, etc.)
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                $cancelAtPeriodEnd = $data['cancel_at_period_end'] ?? false;

                Log::info("Suscripción actualizada para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                    'status' => $data['status'],
                    'cancel_at_period_end' => $cancelAtPeriodEnd,
                ]);

                if ($cancelAtPeriodEnd) {
                    // El usuario ha solicitado cancelar al final del periodo
                    // TODO: Mostrar aviso de cancelación pendiente, etc.
                }

                // TODO: Actualizar permisos si cambió de plan, notificar cambio, etc.
            }
        }

        if ($type === 'customer.subscription.deleted') {
            // Suscripción cancelada/eliminada definitivamente
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Suscripción eliminada para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                ]);
                // TODO: Revocar acceso al plan, limpiar recursos, notificar, etc.
            }
        }

        if ($type === 'customer.subscription.paused') {
            // Suscripción pausada
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Suscripción pausada para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                ]);
                // TODO: Suspender acceso temporalmente, notificar, etc.
            }
        }

        if ($type === 'customer.subscription.resumed') {
            // Suscripción reanudada tras una pausa
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Suscripción reanudada para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                ]);
                // TODO: Reactivar acceso, notificar, etc.
            }
        }

        if ($type === 'customer.subscription.trial_will_end') {
            // El periodo de prueba termina en ~3 días
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Trial por terminar para usuario: {$usuario->id}", [
                    'subscription_id' => $data['id'],
                    'trial_end' => $data['trial_end'] ?? null,
                ]);
                // TODO: Enviar email recordatorio de fin de trial, etc.
            }
        }

        // ─── Cliente ────────────────────────────────────────────
        if ($type === 'customer.updated') {
            // Datos del cliente actualizados en Stripe (email, método de pago, etc.)
            $usuario = Usuarios::where('stripe_id', $data['id'])->first();

            if ($usuario) {
                Log::info("Cliente actualizado en Stripe: {$usuario->id}");
                // TODO: Sincronizar datos si es necesario
            }
        }

        if ($type === 'customer.deleted') {
            // Cliente eliminado en Stripe
            $usuario = Usuarios::where('stripe_id', $data['id'])->first();

            if ($usuario) {
                Log::warning("Cliente eliminado en Stripe: {$usuario->id}");
                // TODO: Limpiar datos de facturación del usuario
            }
        }

        // ─── Disputas / Chargebacks ─────────────────────────────
        if ($type === 'charge.dispute.created') {
            // Se ha abierto una disputa/chargeback
            $usuario = Usuarios::where('stripe_id', $data['customer'] ?? null)->first();

            Log::warning("Disputa creada", [
                'charge_id' => $data['charge'] ?? $data['id'],
                'amount' => $data['amount'] ?? null,
                'usuario_id' => $usuario?->id,
            ]);
            // TODO: Notificar al admin, suspender cuenta si es necesario, etc.
        }

        if ($type === 'charge.refunded') {
            // Se ha realizado un reembolso
            $usuario = Usuarios::where('stripe_id', $data['customer'] ?? null)->first();

            Log::info("Reembolso procesado", [
                'charge_id' => $data['id'],
                'amount_refunded' => $data['amount_refunded'] ?? null,
                'usuario_id' => $usuario?->id,
            ]);
            // TODO: Registrar reembolso, ajustar acceso si corresponde, etc.
        }

        // ─── Stripe Connect ────────────────────────────────────────
        if ($type === 'account.updated') {
            // Cuenta Connect actualizada (onboarding completado, verificación, etc.)
            $accountId = $data['id'];
            $negocio = Negocios::where('stripe_account_id', $accountId)->first();

            if ($negocio) {
                $chargesEnabled = $data['charges_enabled'] ?? false;
                $payoutsEnabled = $data['payouts_enabled'] ?? false;

                Log::info("Cuenta Connect actualizada para negocio: {$negocio->id}", [
                    'stripe_account_id' => $accountId,
                    'charges_enabled' => $chargesEnabled,
                    'payouts_enabled' => $payoutsEnabled,
                ]);

                // TODO: Notificar al negocio cuando su cuenta esté lista para recibir pagos
                if ($chargesEnabled && $payoutsEnabled) {
                    // La cuenta está completamente activa
                }
            }
        }

        if ($type === 'account.application.deauthorized') {
            // El negocio ha desconectado tu plataforma desde su dashboard de Stripe
            $accountId = $event->payload['account'] ?? null;
            $negocio = Negocios::where('stripe_account_id', $accountId)->first();

            if ($negocio) {
                Log::warning("Negocio desconectó Stripe Connect: {$negocio->id}");
                $negocio->update(['stripe_account_id' => null]);
                // TODO: Notificar al negocio, deshabilitar pagos online
            }
        }

        if ($type === 'payout.paid') {
            // Pago enviado al negocio
            $accountId = $event->payload['account'] ?? null;
            $negocio = Negocios::where('stripe_account_id', $accountId)->first();

            if ($negocio) {
                Log::info("Payout enviado a negocio: {$negocio->id}", [
                    'amount' => $data['amount'] ?? null,
                    'currency' => $data['currency'] ?? null,
                ]);
            }
        }

        if ($type === 'payout.failed') {
            // Pago fallido al negocio
            $accountId = $event->payload['account'] ?? null;
            $negocio = Negocios::where('stripe_account_id', $accountId)->first();

            if ($negocio) {
                Log::warning("Payout fallido para negocio: {$negocio->id}", [
                    'failure_code' => $data['failure_code'] ?? null,
                    'failure_message' => $data['failure_message'] ?? null,
                ]);
                // TODO: Notificar al negocio del problema con su cuenta bancaria
            }
        }
    }
}
