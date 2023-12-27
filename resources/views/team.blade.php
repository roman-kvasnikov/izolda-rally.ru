@extends('layouts.base')

@section('title', 'Команда')

@section('content')

<div class="title">
	<h1>Команда</h1>
</div>

<div class="team">
	<div class="row gy-5">
		<div class="col-lg-6 col-md-12">
			<div class="team-member">
				<div class="member-photo">
					<img src="{{ asset('img/crew/1_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="member-name">Маргарита Иконникова</div>

				<div class="member-description">
					<ul>
						<li>Мотиватор и идейный вдохновитель;</li>
						<li>Контент-мейкер в медиа сообществе;</li>
						<li>Финансовый менеджер.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="team-member">
				<div class="member-photo">
					<img src="{{ asset('img/crew/2_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="member-name">Александра Баландина</div>

				<div class="member-description">
					<ul>
						<li>Специалист по связи с общественностью;</li>
						<li>Администратор медиа сообществ;</li>
						<li>Сердце фанатского движения;</li>
						<li>Организатор фан-зоны.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="team-member">
				<div class="member-photo">
					<img src="{{ asset('img/crew/1_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="member-name">Антон Сёмин</div>

				<div class="member-description">
					<ul>
						<li>Оператор и видеомонтажер.</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="team-member">
				<div class="member-photo">
					<img src="{{ asset('img/crew/2_pilot.jpg') }}" class="w-100 img-thumbnail" />
				</div>

				<div class="member-name">Евгений Костриков</div>

				<div class="member-description">
					<ul>
						<li>Профессиональный автомеханик.</li>
						<li>Золотые руки и смекалка.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection