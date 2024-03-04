<?php

namespace App\Services\Orders\Enums;

enum OrderDeliveryMethodEnum: string
{
	case cdek	= 'cdek';
	case pochta	= 'pochta';

	public function name(): string
	{
		return match ($this) {
			self::cdek		=> 'СДЭК',
			self::pochta	=> 'Почта России'
		};
	}
}
