<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\API\ApiReserva;

Route::get('/', [WebController::class, 'inicio'])->name('inicio');
Route::get('/n/{negocio}', [WebController::class, 'negocio'])->name('negocio');
Route::get('/checkout', [WebController::class, 'checkout'])->name('checkout');
Route::post('/verificar-sesion-cliente', [WebController::class, 'verificarSesionCliente'])->name('verificar.sesion.cliente');
Route::post('/crearcliente', [WebController::class, 'crearCliente'])->name('api.cliente');
Route::post('/horas-disponibles', [WebController::class, 'horasDisponibles'])->name('api.horas.disponibles');
Route::apiResource('reserva', ApiReserva::class);

// Reservas
Route::post('/reservar', [ApiReserva::class, 'store'])->name('api.reserva.store');

// Stripe - Checkout de reservas con pago online
Route::get('/checkout/reserva/pago', [StripeController::class, 'pre_checkout'])->name('stripe.pre_checkout');
Route::get('/checkout/reserva/success', [StripeController::class, 'reserva_success'])->name('checkout.reserva.success');
Route::get('/checkout/reserva/cancel', [StripeController::class, 'reserva_cancel'])->name('checkout.reserva.cancel');

Route::get('/a', [WebController::class, 'inicio'])->name('cat_reservas');
Route::get('/d', [WebController::class, 'inicio'])->name('cat_empleados');
Route::get('/da', [WebController::class, 'inicio'])->name('cat_carta_qr');
Route::get('/dw', [WebController::class, 'inicio'])->name('cat_clientes');
Route::get('/dwaw', [WebController::class, 'inicio'])->name('cat_horarios');
Route::get('/adwa', [WebController::class, 'inicio'])->name('franquicias');
Route::get('/3ada', [WebController::class, 'inicio'])->name('manager');
Route::get('/daa', [WebController::class, 'inicio'])->name('registro');
