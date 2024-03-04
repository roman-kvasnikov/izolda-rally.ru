<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\Payment;

class GetPaymentToViewAction
{
	public function __construct(
		private Payment $payment
	) {
		//
	}

	public static function make(Payment $payment): static
	{
		return new static($payment);
	}

	public function run(): array
	{
		return $this->payment->toView();
	}
}
