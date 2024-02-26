<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use Illuminate\Support\Collection;

class GetCartToViewAction
{
    public function run(): Collection
    {
        return Cart::all()
            ->map
            ->toView();
    }
}
