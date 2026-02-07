<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'eventos';

    protected $fillable = [
        'uuid',
        'nombre',
        'descripcion',
        'lugar',
        'stock',
        'precio',
        'negocio_id'
    ];

    public function negocio(): BelongsTo
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }
}
