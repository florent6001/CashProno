<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class WebhookController extends CashierController
{
    /**
     * Handle invoice payment succeeded.
     * @param $payload
     * @return Response
     * @throws Throwable
     */
    public function handleInvoicePaymentSucceeded($payload): Response
    {
        $session = $payload['data']['object'];
        $user = Auth::user();
        // $plan = Subscription::retrieve($session['subscription']['items']['data']['price']['id']);

        DB::transaction(function () use ($session, $user) {
            $user->update(['stripe_id' => $session['customer']]);

            $user->subscriptions()->create([
                'name'          => 'default',
                'stripe_id'     => $session['subscription'],
                'stripe_status' => 'active',
                'stripe_plan'   => config('app.football_price_id'),
                'quantity'      => 1,
                'trial_ends_at' => null,
                'ends_at'       => now()->addDays(30),
            ]);
        });

        return $this->successMethod();
    }
}
