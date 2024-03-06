<?php

namespace App\Services\Tinkoff\Entities;

use App\Services\Tinkoff\Enums\PaymentStatusEnum;

// По сути это сущность которую мы будем отправлять в тинькоф для платежа. И она же приходит от тинькоф когда создаем платеж.

class PaymentEntity
{
	public function __construct(
		public string $id,
		public PaymentStatusEnum $status,
		public string $order,
		public int $amount,
		public ?string $url = null
	) {
		//
	}
}
