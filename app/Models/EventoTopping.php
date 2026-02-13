<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoTopping extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'evento_toppings';

    protected $fillable = [
        'uuid',
        'nombre',
        'descripcion',
        'icono',
        'precio',
        'evento_id',
        'stripe_price',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
        ];
    }

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
