<?php

namespace App\Http\Controllers;

use App\Actions\Cart\AddToCartAction;
use App\Actions\Cart\GetCartToViewAction;
use App\Actions\Cart\RemoveFromCartAction;
use App\Http\Requests\CartRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = (new GetCartToViewAction)
            ->run();

        return view('merch.cart', compact('cart'));
    }

    public function add(CartRequest $request): JsonResponse
    {
        (new AddToCartAction)
            ->run($request->merch_id);

        return response()->json(
            (new GetCartToViewAction)
                ->run()
        );
    }

    public function remove(CartRequest $request): JsonResponse
    {
        (new RemoveFromCartAction)
            ->run($request->merch_id);

        return response()->json(
            (new GetCartToViewAction)
                ->run()
        );
    }

    public function removeAll(CartRequest $request): JsonResponse
    {
        (new RemoveFromCartAction)
            ->run($request->merch_id, true);

        return response()->json(
            (new GetCartToViewAction)
                ->run()
        );
    }
}
