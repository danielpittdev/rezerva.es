<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\ApiNegocio;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ApiServicio;

Route::prefix('/v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/test', [ApiController::class, 'test']);
    Route::apiResource('negocio', ApiNegocio::class);
    Route::apiResource('servicio', ApiServicio::class);
});
