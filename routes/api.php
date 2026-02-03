<?php

use App\Http\Controllers\API\ApiReserva;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'inicio']);
Route::apiResource('reserva', ApiReserva::class);
