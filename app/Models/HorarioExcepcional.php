<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioExcepcional extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'horarios_excepciones';

    protected $fillable = [
        'uuid',
        'fecha',
        'franja_inicio',
        'franja_final',
        'cerrado',
        'negocio_id',
    ];

    protected function casts(): array
    {
        return [
            'cerrado' => 'boolean'
        ];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }
}
