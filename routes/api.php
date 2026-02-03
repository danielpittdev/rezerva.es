<?php

use Illuminate\Http\Request;
use App\Listeners\WebhookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\ApiCliente;
use App\Http\Controllers\API\ApiHorario;
use App\Http\Controllers\API\ApiNegocio;
use App\Http\Controllers\API\ApiReserva;
use App\Http\Controllers\API\ApiUsuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ApiEmpleado;
use App\Http\Controllers\API\ApiServicio;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\API\ApiServicioConf;

Route::prefix('/v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/test', [ApiController::class, 'test']);
    Route::apiResource('usuario', ApiUsuario::class);
    Route::apiResource('negocio', ApiNegocio::class)->middleware('plan.limite:negocios');
    Route::apiResource('empleado', ApiEmpleado::class)->middleware('plan.limite:empleados');
    Route::apiResource('servicio', ApiServicio::class)->middleware('plan.limite:servicios');;
    Route::apiResource('servicioConf', ApiServicioConf::class);
    Route::apiResource('horario', ApiHorario::class);
    Route::apiResource('horarioExc', ApiHorario::class);
    Route::get('reserva/buscar', [ApiReserva::class, 'show'])->name('reserva.buscar');
    Route::apiResource('reserva', ApiReserva::class);
    Route::apiResource('cliente', ApiCliente::class)->middleware('plan.limite:clientes');;
});
