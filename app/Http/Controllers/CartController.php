<?php

namespace App\Http\Controllers;

use App\Services\Carts\CartService;
use App\Services\Carts\Requests\CartRequest;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
	public function index(CartService $cartService): View
	{
		$cart = $cartService
			->getCartToView()
			->run();

		return view('merches.cart', compact('cart'));
	}

	public function add(CartService $cartService, CartRequest $request): JsonResponse
	{
		$cartService
			->addToCart($request->validated())
			->run();

		return response()->json(
			$cartService
				->getCartToView()
				->run()
		);
	}

	public function remove(CartService $cartService, CartRequest $request): JsonResponse
	{
		$cartService
			->removeFromCart($request->validated())
			->run();

		return response()->json(
			$cartService
				->getCartToView()
				->run()
		);
	}
}
