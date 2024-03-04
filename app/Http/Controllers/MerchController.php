<?php

namespace App\Http\Controllers;

use App\Services\Merches\MerchService;
use App\Services\Carts\CartService;

use Illuminate\Contracts\View\View;

class MerchController extends Controller
{
	public function __invoke(MerchService $merchService, CartService $cartService): View
	{
		$merches = $merchService
			->getMerchesToView()
			->run();

		$cart = $cartService
			->getCartToView()
			->run();

		return view('merches.index', compact('merches', 'cart'));
	}
}
