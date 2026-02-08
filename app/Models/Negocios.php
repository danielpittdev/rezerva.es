<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Contracts\EventDispatcher\Event;

class Negocios extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'nombre',
        'slug',
        'descripcion',
        'tipo',
        'postal_direccion',
        'postal_codigo',
        'postal_ciudad',
        'postal_pais',
        'info_email',
        'info_telefono',
        'moneda',
        'icono',
        'banner',
        'stripe_account_id',
        'verificado',
        'usuario_id'
    ];

    public function stripeAccountActivo(): bool
    {
        return !empty($this->stripe_account_id);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected function casts(): array
    {
        return [
            'verificado' => 'boolean',
        ];
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }

    public function servicios()
    {
        return $this->hasMany(Servicios::class, 'negocio_id');
    }

    public function horarios_recurrentes()
    {
        return $this->hasMany(Horarios::class, 'negocio_id');
    }

    public function horarios_puntuales()
    {
        return $this->hasMany(HorarioExcepcional::class, 'negocio_id');
    }

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'negocio_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'negocio_id');
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'negocio_id');
    }

    public function colaboradores()
    {
        return $this->hasMany(Colaboradores::class, 'negocio_id');
    }

    public function facturas()
    {
        return $this->hasMany(Facturas::class, 'negocio_id');
    }

    public function reservas()
    {
        return $this->hasManyThrough(Reserva::class, Servicios::class, 'negocio_id', 'servicio_id');
    }
}
