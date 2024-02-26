<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Contracts\Payable;
use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Models\Payment;

class CreatePaymentAction
{
	private readonly Payable $payable;

	public function payable(Payable $payable): static
	{
		$this->payable = $payable;

		return $this;
	}

	public function run(): Payment
	{
		return Payment::updateOrCreate(
			[
				'payable_type' => $this->payable->getPayableType(),
				'payable_id' => $this->payable->getPayableId(),
				'status' => PaymentStatusEnum::pending,
			],
			[
				'currency_id' => $this->payable->getPayableCurrencyId(),
				'amount' => $this->payable->getPayableAmount(),
				'method_id' => null,
				'driver' => null,
			]
		);
	}
}
