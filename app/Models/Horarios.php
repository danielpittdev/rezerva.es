<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'dia',
        'franja_inicio',
        'franja_final',
        'negocio_id',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }
}
