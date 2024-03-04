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
		// На самом деле нужно при каждом создании платежа создавать именно НОВЫЙ Платеж.. Не проверять на наличие уже существующего. Пока не буду переделывать, но в перспективе это нужно. Именно поэтому кнопка перейти к оплате у нас реализована через форму с методом POST.

		return Payment::query()
			->create(
				[
					'status' => PaymentStatusEnum::pending,
					'currency_id' => $this->payable->getPayableCurrencyId(),
					'amount' => $this->payable->getPayableAmount(),
					'payable_type' => $this->payable->getPayableType(),
					'payable_id' => $this->payable->getPayableId(),
					'method_id' => null,
					'driver' => null,
				]
			);
	}
}
