@extends('layouts.base')

@section('title', 'Заказы'.' - '.config('app.name'))

@section('content')

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
	<div class="container">
		<a class="navbar-brand" href="{{ route('orders') }}">Магазин</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('orders') }}">Мои заказы</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<section>
	<div class="container">
		<h4 class="mb-3">Оплата</h4>

		<div class="card">
			<div class="cart-body">
				<h5 class="card-title p-3">Детали платежа</h5>
			</div>

			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							ID платежа
						</div>
						<div class="col-8">
							{{ $payment->uuid }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Сумма платежа
						</div>
						<div class="col-8">
							{{ $payment->amount }} {{ $payment->currency_id }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Статус платежа
						</div>
						<div class="col-8 text-{{ $payment->status->color() }}">
							{{ $payment->status->name() }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Операция
						</div>
						<div class="col-8">
							{{ $payment->payable->getPayableName() }}
						</div>
					</div>
				</li>
			</ul>

			<div class="cart-body p-3">
				@if ($methods->isEmpty())
				Извините, оплата временно недоступна
				@else
				@if ($errors->any())
				<div class="mb-3 text-danger">{{ $errors->first() }}</div>
				@endif

				<form action="{{ route('payments.method', $payment->uuid) }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="mb-md-0">
								<select name="method_id" class="form-control">
									<option value="">Способ оплаты</option>
									@foreach ($methods as $method)
									<option value="{{ $method->id }}">{{ $method->name }} ({{ $method->driver_currency_id }})</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<button type="submit" class="btn btn-primary w-100">Продолжить</button>
						</div>
					</div>
				</form>
				@endif
			</div>
		</div>
	</div>
</section>

@endsection