<?php

namespace App\Services\Merches\Actions;

use App\Services\Merches\Models\Merch;

use Illuminate\Support\Collection;

class GetMerchesToViewAction
{
	public function run(): Collection
	{
		return Merch::all()
			->map
			->toView();
	}
}
