<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('api_login');
Route::post('/registro', [AuthController::class, 'registro'])->name('api_registro');

Route::prefix('/v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/test', [ApiController::class, 'test']);
});
