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
		<div class="d-flex justify-content-between mb-3">
			<div>
				<h4>Мои подписки</h4>
			</div>
			<div>
				<a href="{{ route('subscriptions.create') }}" class='btn btn-primary btn-sm'>Подписаться</a>
			</div>
		</div>

		<div class="card">
			<div class="cart-body">
				<h5 class="card-title p-3">Детали подписки</h5>
			</div>

			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							ID подписки
						</div>
						<div class="col-8">
							{{ $subscription->uuid }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Сумма подписки
						</div>
						<div class="col-8">
							{{ money($subscription->price, $subscription->currency_id) }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Статус подписки
						</div>
						<div class="col-8 text-{{ $subscription->status->color() }}">
							{{ $subscription->status->name() }}
						</div>
					</div>
				</li>
			</ul>

			@if ($subscription->status->isPending())
			<div class="cart-body p-3">
				<form action="{{ route('subscriptions.payment', $subscription->uuid) }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-primary">Перейти к оплате</button>
				</form>
			</div>
			@endif
		</div>
	</div>
</section>

@endsection