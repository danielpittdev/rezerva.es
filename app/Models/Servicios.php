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
        'stock',
        'tipo',
        'pago_online',
        'stripe_id',
        'icono',
        'negocio_id',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'stock' => 'decimal:0',
            'pago_online' => 'boolean',
        ];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    public function configuraciones()
    {
        return $this->hasMany(ServiciosConf::class, 'servicio_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reservas::class, 'servicio_id');
    }

    public function facturas()
    {
        return $this->hasMany(Facturas::class, 'servicio');
    }
}
