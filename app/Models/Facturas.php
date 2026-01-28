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
        'stripe_id',
        'stripe_monto',
        'monto',
        'comision',
        'total',
        'negocio',
        'servicio',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'comision' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function negocioRelation()
    {
        return $this->belongsTo(Negocios::class, 'negocio');
    }

    public function servicioRelation()
    {
        return $this->belongsTo(Servicios::class, 'servicio');
    }
}
