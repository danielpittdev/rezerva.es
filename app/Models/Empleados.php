<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'tipo',
        'estado',
        'negocio_id',
    ];

    protected function casts(): array
    {
        return [
            'tipo' => 'string',
            'estado' => 'string',
        ];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'empleado_id');
    }
}
