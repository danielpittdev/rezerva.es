<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\WebController;

Route::get('/login', [WebController::class, 'login'])->name('login');
Route::get('/registro', [WebController::class, 'registro'])->name('registro');
Route::get('/restablecer', [WebController::class, 'restablecer'])->name('recuperar');
Route::get('/resetear/{id}', [WebController::class, 'resetear'])->name('resetear');

Route::prefix('/panel')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [PanelController::class, 'inicio']);
    Route::get('/negocios', [PanelController::class, 'negocios']);
    Route::get('/clientes', [PanelController::class, 'clientes']);
});
