<?php

use App\Services\Currencies\CurrencyService;
use App\Services\Currencies\Models\Currency;
use App\Support\Values\AmountValue;

function currency(): string
{
	return session('currency', Currency::MAIN);
}

function convert(AmountValue $amount): AmountValue
{
	/** @var CurrencyService */
	$service = app(CurrencyService::class);

	return $service->convert()
		->from(Currency::MAIN)
		->to(currency())
		->run($amount);
}

function money(AmountValue $amount, string $currency): string
{
	$amount = $amount->add(new AmountValue(0), 2);

	$amount = number_format($amount->value(), 2, ',', ' ');

	$postfix = match ($currency) {
		Currency::RUB => ' ₽',
		Currency::USD => ' $',
		Currency::EUR => ' €'
	};

	return "{$amount} {$postfix}";
}
