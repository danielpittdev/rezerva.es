<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Factura extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'monto',
        'comision',
        'total',
        'datos',
        'reserva_id',
    ];

    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'comision' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'id');
    }
}
