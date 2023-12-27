<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;

class SendMessageController extends Controller
{
	public function __invoke(SendMessageRequest $request)
	{
		$data = $request -> validated();
		return $data;
	}
}
