@extends('layouts.base')

@section('title', 'Заказ'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Детали заказа</h1>
</div>

<orders-component :order='@json($order)' />

@endsection