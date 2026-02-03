<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'inicio']);

Route::get('/a', [WebController::class, 'inicio'])->name('cat_reservas');
Route::get('/d', [WebController::class, 'inicio'])->name('cat_empleados');
Route::get('/da', [WebController::class, 'inicio'])->name('cat_carta_qr');
Route::get('/dw', [WebController::class, 'inicio'])->name('cat_clientes');
Route::get('/dwaw', [WebController::class, 'inicio'])->name('cat_horarios');
Route::get('/adwa', [WebController::class, 'inicio'])->name('franquicias');
Route::get('/3ada', [WebController::class, 'inicio'])->name('manager');
Route::get('/daa', [WebController::class, 'inicio'])->name('registro');
