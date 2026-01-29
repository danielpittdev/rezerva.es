<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;

Route::get('/login', [WebController::class, 'login'])->name('login');
Route::get('/registro', [WebController::class, 'registro'])->name('registro');
Route::get('/recuperar', [WebController::class, 'recuperar'])->name('recuperar');
Route::get('/resetear/{id}', [WebController::class, 'resetear'])->name('resetear');

Route::post('/login', [AuthController::class, 'login'])->name('api_login');
Route::post('/registro', [AuthController::class, 'registro'])->name('api_registro');
Route::post('/recuperar', [AuthController::class, 'recuperar'])->name('api_recuperar');
Route::post('/restablecer', [AuthController::class, 'restablecer'])->name('api_restablecer');

Route::prefix('/panel')->middleware('auth:web')->group(function () {
    Route::get('/', [PanelController::class, 'inicio'])->name('panel');
    Route::get('/negocios', [PanelController::class, 'negocios'])->name('panel_negocios');
    Route::get('/clientes', [PanelController::class, 'clientes'])->name('panel_clientes');
});
