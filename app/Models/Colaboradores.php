<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaboradores extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'tipo',
        'usuario_id',
        'negocio_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }
}
