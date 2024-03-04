<?php

namespace App\Services\Orders\Actions;

use App\Services\Carts\Models\Cart;
use App\Services\Merches\Models\Merch;
use App\Services\Orders\Models\Order;
use App\Services\Orders\Enums\OrderStatusEnum;

class CompleteOrderAction
{
	public function run(Order $order): void
	{
		Cart::query()
			->where('session_id', $order->cart_session_id)
			->get()
			->map(
				function (Cart $cart) {
					Merch::findOrFail($cart->merch_id)
						->decrement('quantity', $cart->quantity);

					return $cart;
				}
			)
			->each
			->delete();

		$order->update(['status' => OrderStatusEnum::completed]);
	}
}
