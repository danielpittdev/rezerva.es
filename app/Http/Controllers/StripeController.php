<?php

namespace App\Http\Controllers;

use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function crear_suscripcion(Request $request)
    {
        $validacion = $request->validate([
            'plan' => 'required|string|exists:planes,slug'
        ]);

        $plan = Planes::where('slug', $request->plan)->first();

        return $request->user()
            ->newSubscription($plan->slug, $plan->stripe_id)
            // ->trialDays(0)
            ->allowPromotionCodes()
            ->checkout([
                'metadata' => ['usuario' => Auth::user()->id],
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);
    }
}
