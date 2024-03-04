<?php

namespace App\Services\Orders\Actions;

use App\Services\Currencies\Models\Currency;
use App\Services\Orders\Enums\OrderStatusEnum;
use App\Services\Orders\Models\Order;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Collection;

class CreateOrderAction
{
	private readonly Collection $cart;

	public function cart(Collection $cart): static
	{
		$this->cart = $cart;

		return $this;
	}

	public function run(): Order
	{
		$order_price = $this->cart->sum(
			function ($cartItem) {
				return $cartItem->merch->price->mul(new AmountValue($cartItem->quantity))->value();
			}
		);

		return Order::query()
			->updateOrCreate(
				[
					'cart_session_id' => $this->cart->first()->session_id,
					'status' => OrderStatusEnum::pending,
				],
				[
					'currency_id' => Currency::RUB,
					'amount' => new AmountValue($order_price),
				]
			);
	}
}
