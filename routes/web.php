<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
  return response()->json([
    'message' => true
  ]);
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('api_login');
Route::post('/registro', [AuthController::class, 'registro'])->name('api_registro');
Route::post('/recuperar', [AuthController::class, 'recuperar'])->name('api_recuperar');
Route::post('/restablecer', [AuthController::class, 'restablecer'])->name('api_restablecer');
