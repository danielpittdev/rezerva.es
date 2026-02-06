<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'nombre',
        'descripcion',
        'precio',
        'pago_online',
        'duracion',
        'stripe_id',
        'stripe_product_id',
        'icono',
        'negocio_id',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'pago_online' => 'boolean',
            'duracion' => 'integer',
        ];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    public function preguntas()
    {
        return $this->hasMany(ServiciosConf::class, 'servicio_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'servicio_id');
    }

    public function facturas()
    {
        return $this->hasMany(Facturas::class, 'servicio');
    }
}
