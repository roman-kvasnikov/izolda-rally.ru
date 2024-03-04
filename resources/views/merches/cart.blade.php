@extends('layouts.base')

@section('title', 'Корзина'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Корзина</h1>
</div>

<cart-component :cart='@json($cart)' />

@endsection