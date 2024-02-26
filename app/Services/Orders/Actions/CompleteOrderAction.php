<?php

namespace App\Services\Orders\Actions;

use App\Models\Cart;
use App\Models\Merch;
use App\Services\Orders\Enums\OrderStatusEnum;
use App\Services\Orders\Models\Order;

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
