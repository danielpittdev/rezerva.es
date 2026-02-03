<?php

namespace App\Providers;

use App\Listeners\WebhookController;
use App\Models\Usuarios;
use App\Models\Suscripcion;
use App\Models\SuscripcionItem;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Events\WebhookReceived;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
        Cashier::useCustomerModel(Usuarios::class);
        Cashier::useSubscriptionModel(Suscripcion::class);
        Cashier::useSubscriptionItemModel(SuscripcionItem::class);

        Event::listen(WebhookReceived::class, WebhookController::class);
    }
}
