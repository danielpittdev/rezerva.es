<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Support\Facades\Mail;
use App\Models\ReservaEvento;

class EnviarCorreoEvento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    public function __construct(
        public int $reservaId,
        public string $titulo,
        public string $cuerpo,
    ) {}

    public function middleware(): array
    {
        return [new RateLimited('correos')];
    }

    public function handle(): void
    {
        $reserva = ReservaEvento::with('cliente', 'evento.negocio')->find($this->reservaId);

        if (!$reserva || !$reserva->cliente->email) {
            return;
        }

        $cliente = $reserva->cliente;
        $evento = $reserva->evento;
        $negocio = $evento->negocio;

        Mail::send('components.email.evento.aviso-masivo', [
            'asunto' => $this->titulo,
            'cuerpo' => $this->cuerpo,
            'cliente' => $cliente,
            'negocio' => $negocio,
            'evento' => $evento,
        ], function ($message) use ($cliente) {
            $message->to($cliente->email, $cliente->nombre . ' ' . $cliente->apellido)
                ->subject('Aviso importante');
        });
    }
}
