<?php

namespace App\Actions\Cart;

use App\Models\Cart;

class RemoveFromCartAction
{
    public function run(int $merch_id, bool $total = false): void
    {
        $cart = Cart::query()
            ->where('merch_id', $merch_id)
            ->first();

        if ($cart) {
            if ($total) {
                $cart->delete();

                return;
            }

            if ($cart->quantity > 1) {
                $cart->update([
                    'quantity' => $cart->quantity - 1,
                ]);
            } else {
                $cart->delete();
            }
        }
    }
}
