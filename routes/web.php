<?php

use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeConnectController;

Route::get('/', function () {
    return redirect('login');
})->name('inicio');

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
    // Route::get('/negocios', [PanelController::class, 'negocios'])->name('negocios');
    Route::get('/empleados', [PanelController::class, 'empleados'])->name('empleados');
    Route::get('/servicios', [PanelController::class, 'servicios'])->name('servicios');
    Route::get('/facturacion', [PanelController::class, 'facturacion'])->name('facturacion');
    Route::get('/clientes', [PanelController::class, 'clientes'])->name('clientes');
    Route::get('/reservas', [PanelController::class, 'reservas'])->name('reservas');
    Route::get('/horarios', [PanelController::class, 'horarios'])->name('horarios');
    Route::get('/ajustes', [PanelController::class, 'ajustes'])->name('ajustes');

    Route::prefix('single')->middleware('auth:web')->group(function () {
        Route::get('/', [PanelController::class, 'inicio'])->name('single');
        Route::get('/negocio/{id}', [SingleController::class, 'negocio'])->name('negocio');
        Route::get('/empleado/{id}', [SingleController::class, 'empleado'])->name('empleado');
        Route::get('/reserva/{id}', [SingleController::class, 'reserva'])->name('reserva');
        Route::get('/servicio/{id}', [SingleController::class, 'servicio'])->name('servicio');
        Route::get('/cliente/{id}', [SingleController::class, 'cliente'])->name('cliente');
    });
});

Route::post('/checkout', [StripeController::class, 'crear_suscripcion'])->name('checkout');
Route::post('/billing-portal', [StripeController::class, 'billing_portal'])->name('billing.portal')->middleware('auth:web');

// Stripe Connect
Route::middleware('auth:web')->prefix('stripe/connect')->name('stripe.connect.')->group(function () {
    Route::post('/onboarding/{negocio}', [StripeConnectController::class, 'onboarding'])->name('onboarding');
    Route::get('/callback/{negocio}', [StripeConnectController::class, 'callback'])->name('callback');
    Route::get('/refresh/{negocio}', [StripeConnectController::class, 'refresh'])->name('refresh');
    Route::get('/status/{negocio}', [StripeConnectController::class, 'status'])->name('status');
    Route::post('/dashboard/{negocio}', [StripeConnectController::class, 'dashboard'])->name('dashboard');
    Route::delete('/disconnect/{negocio}', [StripeConnectController::class, 'disconnect'])->name('disconnect');
});
