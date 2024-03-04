<?php

namespace App\Services\Carts\Actions;

class CartActionData
{
	public readonly int $merch_id;
	public readonly int $quantity;
	public readonly bool $total;

	public function __construct(array $data)
	{
		$this->merch_id = $data['merch_id'];
		$this->quantity = isset($data['quantity']) ? $data['quantity'] : 1;
		$this->total = isset($data['total']) ? $data['total'] : false;
	}
}
