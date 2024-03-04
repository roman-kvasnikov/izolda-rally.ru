<?php

namespace App\Services\Orders;

use App\Services\Orders\Actions\CreateOrderAction;
use App\Services\Orders\Actions\CompleteOrderAction;
use App\Services\Orders\Actions\CancelOrderAction;
use App\Services\Orders\Actions\GetOrderToViewAction;
use App\Services\Orders\Models\Order;

class OrderService
{
	public function createOrder(): CreateOrderAction
	{
		return new CreateOrderAction;
	}

	public function completeOrder(): CompleteOrderAction
	{
		return new CompleteOrderAction;
	}

	public function cancelOrder(): CancelOrderAction
	{
		return new CancelOrderAction;
	}

	public function getOrderToView(Order $order): GetOrderToViewAction
	{
		return GetOrderToViewAction::make($order);
	}
}
