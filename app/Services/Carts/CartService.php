<?php

namespace App\Services\Carts;

use App\Services\Carts\Actions\CartActionData;
use App\Services\Carts\Actions\AddToCartAction;
use App\Services\Carts\Actions\RemoveFromCartAction;
use App\Services\Carts\Actions\GetCartToViewAction;

class CartService
{
	public function addToCart(array $data): AddToCartAction
	{
		return AddToCartAction::make(new CartActionData($data));
	}

	public function removeFromCart(array $data): RemoveFromCartAction
	{
		return RemoveFromCartAction::make(new CartActionData($data));
	}

	public function getCartToView(): GetCartToViewAction
	{
		return new GetCartToViewAction;
	}
}
