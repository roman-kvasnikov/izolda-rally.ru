<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Оплата</title>
</head>

<body>
	<form id="payment-form">
		<div id="payment-element">
			<!--Stripe.js injects the Payment Element-->
		</div>

		<div id="payment-message" class="hidden"></div>

		<button id="submit">
			<div class="spinner hidden" id="spinner"></div>
			<span id="button-text">Pay now</span>
		</button>
	</form>

	<script src="https://js.stripe.com/v3/"></script>

	<script>
		// This is your test publishable API key.
		const stripe = Stripe("{{ config('services.stripe.public_key') }}");

		const elements = stripe.elements({
			clientSecret: '{{ $intent->client_secret }}',
			locale: "{{ config('app.locale') }}"
		});

		const paymentElement = elements.create('payment');

		paymentElement.mount('#payment-element');

		document.getElementById('payment-form')
			.addEventListener('submit', async (event) => {
				event.preventDefault();

				stripe.confirmPayment({
						elements: elements,
						confirmParams: {
							// Return URL where the customer should be redirected after the PaymentIntent is confirmed.
							return_url: "{{ route('payments.success', ['uuid' => $payment->uuid]) }}",
						},
					})
					.then(function(result) {
						if (result.error) {
							document.getElementById('payment-message').textContent = result.error.message;
							document.getElementById('payment-message').classList.remove('d-none');
						} else {
							document.getElementById('payment-message').classList.add('d-none');
							document.getElementById('payment-message').textContent = '';
						}
					});
			});
	</script>
</body>

</html>