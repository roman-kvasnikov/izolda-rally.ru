<?php

namespace App\Services\Orders;

use App\Services\Orders\Actions\CancelOrderAction;
use App\Services\Orders\Actions\CompleteOrderAction;
use App\Services\Orders\Actions\CreateOrderAction;

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
}
