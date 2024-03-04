<?php

namespace App\Services\Merches;

use App\Services\Merches\Actions\GetMerchesToViewAction;

class MerchService
{
	public function getMerchesToView(): GetMerchesToViewAction
	{
		return new GetMerchesToViewAction;
	}
}
