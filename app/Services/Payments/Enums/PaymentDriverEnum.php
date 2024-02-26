<?php

namespace App\Services\Payments\Enums;

enum PaymentDriverEnum: string
{
    case test = 'test';
    case tinkoff = 'tinkoff';
    // Можно добавить один способ страйп, потому что нет смысла добавлять оба, типа либо так либо так. Но в рамках курса делаем просто оба вида.
    case stripe_elements = 'stripe_elements';
    case stripe_checkout = 'stripe_checkout';

    public function name(): string
    {
        return match ($this) {
            self::test => 'Тестовый провайдер',
            self::tinkoff => 'Tinkoff',
            self::stripe_elements => 'Stripe Elements',
            self::stripe_checkout => 'Stripe Checkout'
        };
    }

    public function isTest(): bool
    {
        return $this === self::test;
    }
}
