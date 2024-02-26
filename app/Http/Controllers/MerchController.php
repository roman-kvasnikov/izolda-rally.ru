<?php

namespace App\Http\Controllers;

use App\Actions\Cart\GetCartToViewAction;
use App\Actions\Merch\GetMerchToViewAction;
use Illuminate\Contracts\View\View;

class MerchController extends Controller
{
    public function __invoke(): View
    {
        $merch = (new GetMerchToViewAction)
            ->run();

        $cart = (new GetCartToViewAction)
            ->run();

        return view('merch.index', compact('merch', 'cart'));
    }
}
