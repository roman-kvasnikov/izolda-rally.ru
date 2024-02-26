<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetailsRequest;
use App\Models\Cart;
use App\Services\Orders\Models\Order;
use App\Services\Orders\OrderService;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create(OrderService $orderService)
    {
        $cart = Cart::all();

        $order = $orderService
            ->createOrder()
            ->cart($cart)
            ->run();

        return to_route('merch.order.show', $order->uuid);
    }

    public function show(Order $order, Request $request)
    {
        // $user = $request->user();

        // abort_unless($user->owns($order), 404);

        // return view('orders.show', compact('order'));

        return view('merch.order.index', compact('order'));
    }

    public function payment(OrderDetailsRequest $request, Order $order, PaymentService $paymentService)
    {
        $validated = $request->validated();

        $order->update($validated);

        $payment = $paymentService
            ->createPayment()
            ->payable($order)
            ->run();

        return to_route('merch.payment.checkout', $payment->uuid);
    }
}
