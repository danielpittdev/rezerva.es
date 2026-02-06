<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'facturas';

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
            'entrante' => 'decimal:2',
            'comision' => 'decimal:2',
            'total' => 'decimal:2',
            'stripe' => 'json'
        ];
    }

    public function negocio(): BelongsTo
    {
        return $this->belongsTo(Negocios::class, 'id');
    }
}
