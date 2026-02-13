<?php

namespace App\Jobs;

use App\Models\ReservaEvento;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RecordatorioEvento implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $reservaEventoId
    ) {}

    public function handle(): void
    {
        $reserva = ReservaEvento::with(['cliente', 'evento'])->find($this->reservaEventoId);

        if (!$reserva || !$reserva->cliente?->email || !$reserva->evento) {
            return;
        }

        // Protección: solo enviar si el evento es realmente mañana (entre 0 y 48h)
        $horasHastaEvento = now()->diffInHours(Carbon::parse($reserva->evento->fecha), false);
        if ($horasHastaEvento < 0 || $horasHastaEvento > 48) {
            Log::info('RecordatorioEvento: omitido, fecha ya no coincide', [
                'reserva_evento_id' => $this->reservaEventoId,
                'fecha_evento' => $reserva->evento->fecha,
            ]);
            return;
        }

        $datos = [
            'uuid' => $reserva->uuid,
            'cliente' => [
                'nombre' => $reserva->cliente->nombre,
                'apellido' => $reserva->cliente->apellido,
                'email' => $reserva->cliente->email,
            ],
            'evento' => [
                'nombre' => $reserva->evento->nombre,
                'fecha' => $reserva->evento->fecha,
                'lugar' => $reserva->evento->lugar,
            ],
            'cantidad' => $reserva->cantidad,
        ];

        Mail::send('components.email.evento.recordatorio', [
            'reserva' => $datos,
        ], function ($message) use ($datos) {
            $message->to($datos['cliente']['email'], $datos['cliente']['nombre'] . ' ' . $datos['cliente']['apellido'])
                ->subject('Recordatorio: tu evento es mañana');
        });

        Log::info('RecordatorioEvento: recordatorio enviado', ['reserva_evento_id' => $this->reservaEventoId]);
    }
}
