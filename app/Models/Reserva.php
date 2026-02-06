<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'servicio_id',
        'cliente_id',
        'empleado_id',
        'nota',
        'fecha',
        'estado',
        'pagado',
        'stripe_payment_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'pagado' => 'boolean',
        ];
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'servicio_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function negocio()
    {
        return $this->hasOneThrough(
            Negocios::class,
            Servicios::class,
            'id',
            'id',
            'servicio_id',
            'negocio_id'
        );
    }
}
