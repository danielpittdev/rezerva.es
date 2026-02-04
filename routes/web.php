<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\API\ApiReserva;
use App\Http\Controllers\StripeController;

Route::get('/', [WebController::class, 'inicio'])->name('inicio');
Route::get('/n/{negocio}', [WebController::class, 'negocio'])->name('negocio');
Route::get('/r/{reserva}', [WebController::class, 'reserva'])->name('reserva');
Route::get('/checkout', [WebController::class, 'checkout'])->name('checkout');
Route::get('/registro', [WebController::class, 'registro'])->name('registro');

Route::get('/contacto', [WebController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [ApiController::class, 'contacto'])->name('api_contacto');

// Reservas
Route::post('/reservar', [ApiReserva::class, 'store'])->name('api.reserva.store');

// Stripe - Checkout de reservas con pago online
Route::get('/checkout/reserva/pago', [StripeController::class, 'pre_checkout'])->name('stripe.pre_checkout');
Route::get('/checkout/reserva/success', [StripeController::class, 'reserva_success'])->name('checkout.reserva.success');
Route::get('/checkout/reserva/cancel', [StripeController::class, 'reserva_cancel'])->name('checkout.reserva.cancel');

# Legal 
Route::get('/contrato', [WebController::class, 'contrato'])->name('contrato');
Route::get('/cookies', [WebController::class, 'cookies'])->name('cookies');
Route::get('/legal', [WebController::class, 'legal'])->name('legal');
Route::get('/privacidad', [WebController::class, 'privacidad'])->name('privacidad');

# Categorias 
Route::get('/reservas', [WebController::class, 'reservas'])->name('cat_reservas');
Route::get('/empleados', [WebController::class, 'empleados'])->name('cat_empleados');
Route::get('/carta-qr', [WebController::class, 'carta_qr'])->name('cat_carta_qr');
Route::get('/clientes', [WebController::class, 'clientes'])->name('cat_clientes');
Route::get('/horarios', [WebController::class, 'horarios'])->name('cat_horarios');
Route::get('/franquicias', [WebController::class, 'franquicias'])->name('franquicias');
Route::get('/manager', [WebController::class, 'manager'])->name('manager');

# API
Route::post('/verificar-sesion-cliente', [ApiController::class, 'verificarSesionCliente'])->name('verificar.sesion.cliente');
Route::post('/crearcliente', [ApiController::class, 'crearCliente'])->name('api.cliente');
Route::post('/horas-disponibles', [ApiController::class, 'horasDisponibles'])->name('api.horas.disponibles');
Route::apiResource('reserva', ApiReserva::class);
