<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription as CashierSubscription;

class Suscripcion extends CashierSubscription
{
    protected $table = 'suscripciones';

    public function getForeignKey(): string
    {
        return 'subscription_id';
    }
    protected $fillable = [
        'user_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];
}
