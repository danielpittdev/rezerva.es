<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
        'negocio',
        'cliente',
        'empleado',
        'stripe',
    ];

    protected function casts(): array
    {
        return [
            'negocio' => 'array',
            'cliente' => 'array',
            'empleado' => 'array',
            'stripe' => 'array',
        ];
    }
}
