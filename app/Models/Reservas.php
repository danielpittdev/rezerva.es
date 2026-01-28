<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'estado',
        'servicio_id',
        'pago_online',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'pago_online' => 'boolean',
            'fecha' => 'datetime',
        ];
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'servicio_id');
    }
}
