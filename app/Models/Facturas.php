<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'negocio_id',
        'negocio_data',
        'servicio_data',
        'stripe',
        'entrante',
        'comision',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'negocio_data' => 'array',
            'servicio_data' => 'array',
            'stripe' => 'array',
            'entrante' => 'decimal:2',
            'comision' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function negocio()
    {
        return $this->belongsTo(Negocios::class, 'negocio_id');
    }
}
