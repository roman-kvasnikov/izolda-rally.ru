<?php

namespace App\Http\Controllers;

use App\Services\Payments\Models\Payment;
use App\Services\Payments\PaymentService;
use App\Http\Requests\UpdatePaymentRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
	public function checkout(Payment $payment, PaymentService $paymentService)
	{
		abort_unless($payment->status->isPending(), 404);

		$payment = $paymentService
			->getPaymentToView($payment)
			->run();

		$methods = $paymentService
			->getPaymentMethods()
			// ->currency($payment->currency_id)
			->active()
			->get();

		return view('merches.payments.checkout', compact('payment', 'methods'));
	}

	public function method(
		UpdatePaymentRequest $request,
		PaymentService $paymentService,
		Payment $payment,
	) {
		abort_unless($payment->status->isPending(), 404);

		$method = $paymentService
			->getPaymentMethods()
			->id($request->method_id)
			->active()
			->first();

		abort_unless($method, 404);

		$paymentService
			->updatePayment()
			->method($method)
			->run($payment);

		return $payment->uuid; // Так как работаем с VUE, то возвращаем во VUE uuid, чтобы перенаправлять на роут уже из вью.
		// return redirect()->route('merch.payment.process', $payment->uuid);
	}

	public function process(Payment $payment, PaymentService $paymentService)
	{
		abort_unless($payment->status->isPending(), 404);
		abort_unless($payment->method_id, 404);

		$driver = $paymentService->getDriver($payment->driver);

		return $driver->view($payment);

		// return view("payments.drivers.{$payment->driver->value}", compact('payment'));
		// return view("payments::{$payment->driver->value}", compact('payment'));
	}

	public function complete(Payment $payment, PaymentService $paymentService)
	{
		abort_unless($payment->status->isPending(), 404);
		abort_unless($payment->driver->isTest(), 404);
		abort_if(app()->isProduction(), 404);

		$paymentService->completePayment()->run($payment);

		return redirect()->route('merches.payments.success', [
			'uuid' => $payment->uuid,
		]);
	}

	public function cancel(Payment $payment, PaymentService $paymentService)
	{
		abort_unless($payment->status->isPending(), 404);
		abort_unless($payment->driver->isTest(), 404);
		abort_if(app()->isProduction(), 404);

		$paymentService->cancelPayment()->run($payment);

		return redirect()->route('merches.payments.failure', [
			'uuid' => $payment->uuid,
		]);
	}

	public function success(
		Request $request,
		Payment $payment,
		PaymentService $paymentService
	) {
		$uuid = $request->input('uuid');

		abort_unless(Str::isUuid($uuid), 404);

		$payment = $paymentService
			->getPayments()
			->uuid($uuid)
			->first();

		abort_unless($payment, 404);

		return view('merches.payments.success', compact('payment'));
	}

	public function failure(
		Request $request,
		Payment $payment,
		PaymentService $paymentService
	) {
		$uuid = $request->input('uuid');

		abort_unless(Str::isUuid($uuid), 404);

		$payment = $paymentService
			->getPayments()
			->uuid($uuid)
			->first();

		abort_unless($payment, 404);

		return view('merches.payments.failure', compact('payment'));
	}
}
