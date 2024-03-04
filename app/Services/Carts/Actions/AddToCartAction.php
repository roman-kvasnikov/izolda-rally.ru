<?php

namespace App\Services\Carts\Actions;

use App\Services\Merches\Models\Merch;
use App\Services\Carts\Models\Cart;

class AddToCartAction
{
	public function __construct(
		private int $merch_id,
		private int $quantity
	) {
		//
	}

	public static function make(CartActionData $data): static
	{
		return new static($data->merch_id, $data->quantity);
	}

	public function run(): void
	{
		$cart = Cart::query()
			->where('merch_id', $this->merch_id)
			->first();

		if (!$cart) {
			$merch = Merch::findOrFail($this->merch_id);

			if ($merch->quantity > 0) {
				$this->quantity = ($this->quantity > $merch->quantity) ? $merch->quantity : $this->quantity;

				Cart::query()
					->create([
						'merch_id' => $this->merch_id,
						'quantity' => $this->quantity
					]);
			}
		} else {
			$this->quantity = ($this->quantity + $cart->quantity > $cart->merch->quantity) ?  $cart->merch->quantity - $cart->quantity : $this->quantity;

			$cart->increment('quantity', $this->quantity);
		}
	}
}
