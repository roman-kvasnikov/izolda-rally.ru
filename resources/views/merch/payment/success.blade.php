@extends('layouts.base')

@section('title', 'Платеж'.' - '.config('app.name'))

@section('content')

<section>
	<div class="container">
		<h4 class="mb-3">Оплата прошла успешно</h4>
		<a href="{{ $payment->payable->getPayableUrl() }}" class="btn btn-primary">Продолжить</a>
	</div>
</section>

@endsection