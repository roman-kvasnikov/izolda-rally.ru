<?php

namespace App\Http\Controllers;

use App\Services\Carts\Models\Cart;
use App\Services\Orders\Models\Order;
use App\Services\Orders\OrderService;
use App\Services\Orders\Requests\OrderDetailsRequest;
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

		return to_route('merches.orders.show', $order->uuid);
	}

	public function show(OrderService $orderService, Order $order, Request $request)
	{
		// Это нужно чтобы кидать 404 если юзеру не пренадлежит данный ордер, если будет регистрация юзеров.
		// $user = $request->user();
		// abort_unless($user->owns($order), 404);

		// Это все можно заменить просто на $order->toView(), но малоли что понадобится в будущем, пускай будет в экшоне как и у карт с мерчем.
		$order = $orderService
			->getOrderToView($order)
			->run();

		return view('merches.orders.index', compact('order'));
	}

	public function payment(OrderDetailsRequest $request, Order $order, PaymentService $paymentService): string
	{
		$validated = $request->validated();

		$order->update($validated);

		$payment = $paymentService
			->createPayment()
			->payable($order)
			->run();

		return $payment->uuid; // Так как работаем с VUE, то возвращаем во VUE uuid, чтобы перенаправлять на роут уже из вью.
		// return to_route('merches.payments.checkout', $payment->uuid);
	}
}
