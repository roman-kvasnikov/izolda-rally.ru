@extends('layouts.base')

@section('title', 'Заказы'.' - '.config('app.name'))

@section('content')

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
	<div class="container">
		<a class="navbar-brand" href="#">Магазин</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('orders') }}">Мои заказы</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('subscriptions') }}">Мои подписки</a>
				</li>
			</ul>
			@php($currencies = App\Services\Currencies\Models\Currency::getCached())
			<ul class="navbar-nav mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
						{{ currency() }}
					</a>
					<ul class="dropdown-menu">
						@foreach($currencies as $currency)
						<li><a class="dropdown-item" href="{{ route('currency', $currency) }}">{{ $currency->id }}</a></li>
						@endforeach
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<section>
	<div class="container">
		<h4 class="mb-3">Мои заказы</h4>

		<div class="card">
			<div class="cart-body">
				<h5 class="card-title p-3">Детали заказа</h5>
			</div>

			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							ID заказа
						</div>
						<div class="col-8">
							{{ $order->uuid }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Сумма заказа
						</div>
						<div class="col-8">
							{{ money(convert( $order->amount ), currency()) }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Статус заказа
						</div>
						<div class="col-8 text-{{ $order->status->color() }}">
							{{ $order->status->name() }}
						</div>
					</div>
				</li>
			</ul>

			@if ($order->status->isPending())
			<div class="cart-body p-3">
				<form action="{{ route('orders.payment', $order->uuid) }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-primary">Перейти к оплате</button>
				</form>
			</div>
			@endif
		</div>
	</div>
</section>

@endsection