@extends('layouts.base')

@section('title', 'Платеж'.' - '.config('app.name'))

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
		<h4 class="mb-3">Оплата прошла успешно</h4>
		<a href="{{ $payment->payable->getPayableUrl() }}" class="btn btn-primary">Продолжить</a>
	</div>
</section>

@endsection