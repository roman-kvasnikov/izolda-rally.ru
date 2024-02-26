<?php

namespace App\Services\Payments\Drivers;

use App\Services\Payments\Models\Payment;
use Illuminate\Contracts\View\View;
use Stripe\StripeClient;

class StripeElementsDriver extends PaymentDriver
{
    public function view(Payment $payment): View
    {
        // create payment by Stripe API
        $stripe = new StripeClient(config('services.stripe.secret_key'));

        $intent = $stripe->paymentIntents->create([
            'amount' => $payment->driver_amount->value() * 100,
            'currency' => mb_strtolower($payment->driver_currency_id),
            'metadata' => ['uuid' => $payment->uuid],
            'payment_method_types' => ['card'],
            // 'return_url' => route('payments.success', ['uuid' => $payment->uuid])
        ]);

        return view('payments::stripe-elements', [
            'payment' => $payment,
            'intent' => $intent,
        ]);
    }
}
