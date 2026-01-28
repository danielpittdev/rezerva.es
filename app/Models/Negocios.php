<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocios extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'nombre',
        'descripcion',
        'tipo',
        'postal_direccion',
        'postal_codigo',
        'postal_ciudad',
        'postal_pais',
        'info_email',
        'info_telefono',
        'icono',
        'banner',
        'verificado',
    ];

    protected function casts(): array
    {
        return [
            'verificado' => 'boolean',
            'fecha' => 'datetime',
        ];
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'servicio_id');
    }
}
