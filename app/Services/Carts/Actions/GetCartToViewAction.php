<?php

namespace App\Services\Carts\Actions;

use App\Services\Carts\Models\Cart;
use App\Support\Values\AmountValue;

use Illuminate\Support\Collection;

class GetCartToViewAction
{
	public function run(): Collection
	{
		$cart = Cart::all();

		$items = $cart->map->toView();
		$total_items = $cart->sum('quantity');
		$total_price['value'] = $cart
			->map(
				function ($item) {
					return $item
						->merch
						->price
						->mul(new AmountValue($item->quantity))
						->value();
				}
			)
			->sum();
		$total_price['formatted'] = money(convert(new AmountValue($total_price['value'])), currency());

		return collect([
			'items'			=> $items,
			'total_items'	=> $total_items,
			'total_price'	=> $total_price
		]);
	}
}
