<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\ApiCliente;
use App\Http\Controllers\API\ApiHorario;
use App\Http\Controllers\API\ApiNegocio;
use App\Http\Controllers\API\ApiReserva;
use App\Http\Controllers\API\ApiUsuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ApiServicio;
use App\Http\Controllers\API\ApiServicioConf;

Route::prefix('/v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/test', [ApiController::class, 'test']);
    Route::apiResource('usuario', ApiUsuario::class);
    Route::apiResource('negocio', ApiNegocio::class);
    Route::apiResource('servicio', ApiServicio::class);
    Route::apiResource('servicioConf', ApiServicioConf::class);
    Route::apiResource('horario', ApiHorario::class);
    Route::apiResource('horarioExc', ApiHorario::class);
    Route::get('reserva/buscar', [ApiReserva::class, 'show'])->name('reserva.buscar');
    Route::apiResource('reserva', ApiReserva::class);
    Route::apiResource('cliente', ApiCliente::class);
});
