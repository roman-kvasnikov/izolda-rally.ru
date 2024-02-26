<?php

namespace App\Services\Payments\Drivers;

use App\Services\Payments\Enums\PaymentDriverEnum;
use InvalidArgumentException;

class PaymentDriverFactory
{
    public function make(PaymentDriverEnum $driver): PaymentDriver
    {
        return match ($driver) {
            PaymentDriverEnum::test => app(TestPaymentDriver::class),
            PaymentDriverEnum::tinkoff => app(TinkoffDriver::class),
            PaymentDriverEnum::stripe_elements => app(StripeElementsDriver::class),

            default => throw new InvalidArgumentException(
                'Driver [{$driver}] is not supported'
            )
        };
    }
}
