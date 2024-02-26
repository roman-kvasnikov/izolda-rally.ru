<?php

namespace App\Services\Tinkoff\Enums;

enum PaymentStatusEnum: string
{
    case NEW = 'NEW';
    case REJECTED = 'REJECTED';
    case AUTHORIZED = 'AUTHORIZED';
    case CONFIRMED = 'CONFIRMED';
    case CANCELLED = 'CANCELLED';
    case REVERSED = 'REVERSED';
    case REFUNDED = 'REFUNDED';
}
