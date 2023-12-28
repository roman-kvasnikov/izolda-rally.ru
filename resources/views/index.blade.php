@extends('layouts.base')

@section('title', 'Главная')

@section('content')

<div class="title">
	<h1>Izolda Rally</h1>
</div>

<div class="index">
	<div class="row">
		<div class="col">
			<div>
				<img src="{{ asset('img/izolda-crew.jpg') }}" class="w-100 img-thumbnail" />
			</div>
		</div>
	</div>
</div>

@endsection