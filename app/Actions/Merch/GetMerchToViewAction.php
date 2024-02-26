<?php

namespace App\Actions\Merch;

use App\Models\Merch;
use Illuminate\Support\Collection;

class GetMerchToViewAction
{
	public function run(): Collection
	{
		return Merch::all()
			->map
			->toView();
	}
}
