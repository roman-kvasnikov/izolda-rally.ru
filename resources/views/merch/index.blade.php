@extends('layouts.base')

@section('title', 'Мерч Команды'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Мерч Команды</h1>
</div>

<merch-component :merch='@json($merch)' :cart='@json($cart)' />

@endsection