<?php

namespace App\Services\Carts\Actions;

use App\Services\Carts\Models\Cart;

class RemoveFromCartAction
{
	public function __construct(
		private int $merch_id,
		private int $quantity,
		private bool $total
	) {
		//
	}

	public static function make(CartActionData $data): static
	{
		return new static($data->merch_id, $data->quantity, $data->total);
	}

	public function run(): void
	{
		$cart = Cart::query()
			->where('merch_id', $this->merch_id)
			->first();

		if ($cart) {
			if ($this->total or $cart->quantity <= $this->quantity) {
				$cart->delete();

				return;
			}

			$cart->decrement('quantity', $this->quantity);
		}
	}
}
