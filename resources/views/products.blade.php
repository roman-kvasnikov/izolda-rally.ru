@extends('layouts.base')

@section('title', 'Наш Мерч'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Наш Мерч</h1>
</div>

<products-component :products='@json($products)' />

@endsection