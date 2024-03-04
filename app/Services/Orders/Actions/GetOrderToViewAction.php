<?php

namespace App\Services\Orders\Actions;

use App\Services\Orders\Models\Order;

class GetOrderToViewAction
{
	public function __construct(
		private Order $order
	) {
		//
	}

	public static function make(Order $order): static
	{
		return new static($order);
	}

	public function run(): array
	{
		return $this->order->toView();
	}
}
