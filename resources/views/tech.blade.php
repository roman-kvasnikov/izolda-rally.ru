@extends('layouts.base')

@section('title', 'Техника'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Техника</h1>
</div>

<div class="index">
	<div class="row">
		<div class="col">
			<div>
				<img src="{{ asset('images/activity/image_2.jpg') }}" class="w-100 img-thumbnail" />
			</div>
		</div>
	</div>
</div>

@endsection