<?php

use App\Models\Negocios;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\API\ApiReserva;
use App\Http\Controllers\StripeController;

Route::get('/', [WebController::class, 'inicio'])->name('inicio');
Route::get('/n/{negocio}', [WebController::class, 'negocio'])->name('negocio');
Route::get('/r/{reserva}', [WebController::class, 'reserva'])->name('reserva');
Route::get('/checkout', [WebController::class, 'checkout'])->name('checkout');
Route::get('/registro', function () {
  return redirect('https://panel.rezerva.es/registro');
})->name('registro');

Route::get('/contacto', [WebController::class, 'contacto'])->name('contacto');
Route::post('/contacto', [ApiController::class, 'contacto'])->name('api_contacto');
Route::get('/psicologia', [WebController::class, 'psicologia'])->name('psicologia');

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

Route::get('/sitemap.xml', function () {
  $sitemap = Sitemap::create();

  // Páginas estáticas clave
  $sitemap->add(Url::create('/')->setPriority(1.0));
  $sitemap->add(Url::create('/psicologia')->setPriority(1.0));

  $sitemap->add(Url::create('/registro')->setPriority(0.9));
  $sitemap->add(Url::create('/contacto')->setPriority(0.8));

  // apartados
  $sitemap->add(Url::create('/franquicias')->setPriority(0.8));
  $sitemap->add(Url::create('/manager')->setPriority(0.8));
  $sitemap->add(Url::create('/reservas')->setPriority(0.8));
  $sitemap->add(Url::create('/empleados')->setPriority(0.8));
  $sitemap->add(Url::create('/carta-qr')->setPriority(0.8));
  $sitemap->add(Url::create('/horarios')->setPriority(0.8));
  $sitemap->add(Url::create('/clientes')->setPriority(0.8));

  // Legales
  $sitemap->add(Url::create('/cookies'));
  $sitemap->add(Url::create('/privacidad'));
  $sitemap->add(Url::create('/contrato'));

  // Negocios activos publicados
  $negocios = Negocios::get();
  foreach ($negocios as $negocio) {
    $sitemap->add(
      Url::create(route('negocio', ['negocio' => $negocio->slug]))
        ->setLastModificationDate($negocio->updated_at)
        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        ->setPriority(0.7)
    );
  }

  return $sitemap->toResponse(request());
});
