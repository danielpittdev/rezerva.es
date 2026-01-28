<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'nombre',
        'apellido',
        'email',
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
}
