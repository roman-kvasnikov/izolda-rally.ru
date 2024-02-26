<?php

namespace App\Http\Controllers;

use App\Services\Currencies\Models\Currency;

class CurrencyController extends Controller
{
    public function __invoke(Currency $currency)
    {
        session(['currency' => $currency->id]);

        return back();
    }
}
