@extends('layouts.base')

@section('title', 'Платеж'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Детали платежа</h1>
</div>

<payments-component :payment='@json($payment)' :methods='@json($methods)' />

@endsection