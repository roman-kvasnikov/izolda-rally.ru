@extends('layouts.base')

@section('title', 'Экипаж'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Экипаж</h1>
</div>

<div class="crew">
	<div class="row gy-5">
		<div class="col-lg-6 col-md-12">
			<div class="crew-pilot">
				<h2>1-ый пилот</h2>

				<div class="pilot-photo">
					<img src="{{ asset('images/crew/1_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="pilot-name">Роман Квасников</div>

				<div class="pilot-description">
					<ul>
						<li>Кандидат в мастера спорта;</li>
						<li>В автоспорте с 2016 года;</li>
						<li>Штурман в классическом ралли с 2017 года;</li>
						<li>Пилот в классическом ралли с 2020 года;</li>
						<li>Призер в любительских кольцевых гонках;</li>
						<li>Призер Кубка и Чемпионата России по ралли.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="crew-pilot">
				<h2>2-ой пилот</h2>

				<div class="pilot-photo">
					<img src="{{ asset('images/crew/2_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="pilot-name">Илья Баландин</div>

				<div class="pilot-description">
					<ul>
						<li>Кандидат в мастера спорта;</li>
						<li>В автоспорте с 2013 года;</li>
						<li>Пилот в классическом ралли с 2013 года;</li>
						<li>Штурман в классическом ралли с 2020 года;</li>
						<li>Дебют штурманом на ралли-рейде в 2023 году;</li>
						<li>Призер Кубка и Чемпионата России по ралли;</li>
						<li>Призер ралли-рейда серии «Шелковый путь» 2023.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection