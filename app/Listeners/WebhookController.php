<?php

namespace App\Listeners;

use App\Models\Factura;
use App\Models\Clientes;
use App\Models\Negocios;
use App\Models\Reserva;
use App\Models\Servicios;
use App\Models\Usuarios;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Events\WebhookReceived;

class WebhookController
{
    public function handle(WebhookReceived $event): void
    {
        $type = $event->payload['type'];
        $data = $event->payload['data']['object'];
        $metadata = $data['metadata'] ?? [];

        Log::info("Webhook recibido: {$type}", ['stripe_id' => $data['id'] ?? null]);

        // ─── Checkout (pago único de reserva) ────────────────────
        if ($type === 'checkout.session.completed') {

            $reserva = Reserva::whereUuid($metadata['reserva'])->first();

            $reserva->update([
                'estado' => 'confirmado'
            ]);

            $reserva->save();

            $datos = [
                'negocio' => $reserva->negocio,
                'servicio' => $reserva->servicio,
                'fecha' => $reserva->fecha,
                'usuario' => $reserva->cliente,
                'nota' => $reserva->nota
            ];

            Mail::send('components.email.reserva', [
                'datos' => $datos,
            ], function ($message) use ($datos) {
                $message->to($datos['usuario']['email'], $datos['usuario']['nombre'] . ' ' . $datos['usuario']['apellido'])
                    ->subject('Reserva confirmada');
            });
        }

        // ─── Pagos de suscripciones ─────────────────────────────
        if ($type === 'invoice.payment_succeeded') {
            // Pago exitoso de suscripción (renovación o primer pago)
            $usuario = Usuarios::where('stripe_id', $data['customer'])->first();

            if ($usuario) {
                Log::info("Pago de suscripción exitoso para usuario: {$usuario->id}", [
                    'invoice_id' => $data['id'],
                ]);
                // TODO: Enviar factura por email, registrar pago en historial, etc.
            }
        }

        if ($type === 'invoice.payment_failed') {
            // Pago fallido (tarjeta rechazada, fondos insuficientes, etc.)


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
    }
}
