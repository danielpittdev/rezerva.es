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
        'usuario_id'
    ];

    protected function casts(): array
    {
        return [
            'verificado' => 'boolean',
            'fecha' => 'datetime',
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
}
