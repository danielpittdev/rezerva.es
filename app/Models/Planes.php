<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Traits\HasUuid;

class Planes extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'planes';

    protected $fillable = [
        'uuid',
        'nombre',
        'descripcion',
        'slug',
        'stripe_id',
    ];
}
