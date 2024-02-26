<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\Merch;

class AddToCartAction
{
    public function run(int $merch_id): void
    {
        $cart = Cart::query()
            ->where('merch_id', $merch_id)
            ->first();

        if (! $cart) {
            $merch = Merch::findOrFail($merch_id);

            if ($merch->quantity > 0) {
                Cart::create([
                    'merch_id' => $merch_id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart->update([
                'quantity' => (($cart->quantity + 1) > $cart->merch->quantity) ? $cart->merch->quantity : $cart->quantity + 1,
            ]);
        }
    }
}
