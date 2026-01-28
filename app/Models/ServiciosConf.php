<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiciosConf extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'servicios_conf';

    protected $fillable = [
        'uuid',
        'pregunta',
        'obligatorio',
        'tipo',
        'servicio_id',
    ];

    protected function casts(): array
    {
        return [
            'obligatorio' => 'boolean',
        ];
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'servicio_id');
    }
}
