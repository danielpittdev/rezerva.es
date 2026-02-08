<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
  use HasFactory, HasUuid;

  protected $table = 'eventos';

  protected $fillable = [
    'uuid',
    'nombre',
    'descripcion',
    'lugar',
    'fecha',
    'stock',
    'precio',
    'negocio_id',
    'stripe_price',
  ];

  public function negocio(): BelongsTo
  {
    return $this->belongsTo(Negocios::class, 'negocio_id');
  }

  public function reservas(): HasMany
  {
    return $this->hasMany(ReservaEvento::class, 'evento_id');
  }
}
