<?php

namespace App\Models;

use Laravel\Cashier\SubscriptionItem as CashierSubscriptionItem;

class SuscripcionItem extends CashierSubscriptionItem
{
    protected $table = 'suscripciones_item';

    protected $fillable = [
        'subscription_id',
        'stripe_id',
        'stripe_product',
        'stripe_price',
        'quantity',
        'meter_id',
        'meter_event_name',
    ];
}
