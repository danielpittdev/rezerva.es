<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Contracts\EventDispatcher\Event;

class ReservaEvento extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'reservas_eventos';

    protected $fillable = [
        'uuid',
        'pagado',
        'confirmacion',
        'metodo_pago',
        'cantidad',
        'total',
        'topings',
        'evento_id',
        'cliente_id',
        'stripe'
    ];

    protected $casts = [
        'pagado' => 'boolean',
        'confirmacion' => 'boolean',
        'toppings' => 'json',
    ];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    public function relacionados()
    {
        return ReservaEvento::where('cliente_id', $this->cliente_id)
            ->where('evento_id', $this->evento_id)
            ->where('id', '!=', $this->id)
            ->get();
    }
}
