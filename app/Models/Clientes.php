<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    use HasFactory, HasUuid, Billable;

    protected $fillable = [
        'uuid',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'stripe_id',
        'negocio_id',
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'cliente_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }

    public function eventos()
    {
        return $this->hasManyThrough(ReservaEvento::class, Evento::class);
    }
}
