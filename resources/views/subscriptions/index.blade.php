@extends('layouts.base')

@section('title', 'Подписки'.' - '.config('app.name'))

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

		@if($subscriptions->isEmpty())
		Нет ни одной подписки.
		@else
		<div class="table-responsive">
			<table class="table table-bordered m-0">
				<thead>
					<tr>
						<th class="text-center py-2 px-2">ID</th>
						<th class="text-center py-2 px-2">Price</th>
						<th class="text-center py-2 px-2">Status</th>
						<th class="text-center py-2 px-0"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($subscriptions as $subscription)
					<tr>
						<td class="text-center py-2 px-2">{{ $subscription->uuid }}</td>
						<td class="text-center py-2 px-2">{{ money($subscription->price, $subscription->currency_id) }}</td>
						<td class="text-center py-2 px-2 text-{{ $subscription->status->color() }}">{{ $subscription->status->name() }}</td>
						<td class="text-center py-2 px-0"><a href="{{ route('subscriptions.show', $subscription->uuid) }}">Show</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endif
	</div>
</section>

@endsection