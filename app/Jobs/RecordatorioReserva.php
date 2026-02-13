<?php

namespace App\Jobs;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RecordatorioReserva implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $reservaId
    ) {}

    public function handle(): void
    {
        $reserva = Reserva::with(['cliente', 'servicio', 'negocio'])->find($this->reservaId);

        if (!$reserva || $reserva->estado === 'cancelado' || !$reserva->cliente?->email) {
            return;
        }

        // Protección: solo enviar si la reserva es realmente mañana (entre 0 y 48h)
        $horasHastaReserva = now()->diffInHours(Carbon::parse($reserva->fecha), false);
        if ($horasHastaReserva < 0 || $horasHastaReserva > 48) {
            Log::info('RecordatorioReserva: omitido, fecha ya no coincide', [
                'reserva_id' => $this->reservaId,
                'fecha' => $reserva->fecha,
            ]);
            return;
        }

        $datos = [
            'usuario' => [
                'nombre' => $reserva->cliente->nombre,
                'apellido' => $reserva->cliente->apellido,
                'email' => $reserva->cliente->email,
            ],
            'negocio' => [
                'nombre' => $reserva->negocio->nombre ?? '',
            ],
            'reserva' => [
                'fecha' => $reserva->fecha,
            ],
        ];

        Mail::send('components.email.recordatorio_reserva', [
            'datos' => $datos,
        ], function ($message) use ($datos) {
            $message->to($datos['usuario']['email'], $datos['usuario']['nombre'] . ' ' . $datos['usuario']['apellido'])
                ->subject('Recordatorio: tu reserva es mañana');
        });

        Log::info('RecordatorioReserva: recordatorio enviado', ['reserva_id' => $this->reservaId]);
    }
}
