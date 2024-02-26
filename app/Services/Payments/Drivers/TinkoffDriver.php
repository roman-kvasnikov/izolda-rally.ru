<?php

namespace App\Services\Payments\Drivers;

use App\Services\Payments\Models\Payment;
use App\Services\Tinkoff\Actions\CreatePaymentData;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\Contracts\View\View;

class TinkoffDriver extends PaymentDriver
{
    public function __construct(
        private TinkoffService $tinkoffService
    ) {
        //
    }

    public function view(Payment $payment): View
    {
        $entity = $this->tinkoffService->createPayment(
            new CreatePaymentData(
                amount: $payment->driver_amount->value() * 100, // Умножаем на 100, потому что у Тинькова сумма должна быть в копейках
                order: $payment->uuid,
                successUrl: route('payments.success', ['uuid' => $payment->uuid]),
                failureUrl: route('payments.failure', ['uuid' => $payment->uuid]),
                callbackUrl: route('api.payments.callbacks.tinkoff')
            )
        );

        $payment->update(['driver_payment_id' => $entity->id]);

        return view('payments::tinkoff', compact('payment', 'entity'));
    }
}
