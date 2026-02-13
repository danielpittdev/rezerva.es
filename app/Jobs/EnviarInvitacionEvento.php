<?php

namespace App\Jobs;

use App\Models\ReservaEvento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarInvitacionEvento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    public function __construct(
        public int $reservaId,
    ) {}

    public function handle(): void
    {
        $reserva = ReservaEvento::with('cliente', 'evento')->find($this->reservaId);

        if (!$reserva || !$reserva->cliente?->email || $reserva->evento?->fecha < now()) {
            return;
        }

        $cliente = $reserva->cliente;
        $evento = $reserva->evento;

        Mail::send('components.email.evento.invitacion', [
            'cliente' => $cliente,
            'evento' => $evento,
            'reserva' => $reserva,
        ], function ($message) use ($cliente, $evento) {
            $message->to($cliente->email, $cliente->nombre . ' ' . $cliente->apellido)
                ->subject('Invitación a ' . $evento->nombre);
        });
    }
}
