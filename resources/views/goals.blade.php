@extends('layouts.base')

@section('title', 'Цели и задачи'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Цели и задачи</h1>
</div>

<div class="goals">
	<div class="row">
		<div class="col-lg-8 col-md-12 px-3">
			<p>Главные цели команды - Стать Чемпионами России по классическому Ралли в своем классе и получить спортивное звание "Мастеров Спорта" по автомобильному спорту.</p>
			<p>Не менее важной целью является продолжение популяризации ралли среди людей для привлечения новых участников и болельщиков. Мы хотим сделать дисциплину Ралли одной из самых популярных в автоспорте в России.</p>
			<p>Наши задачи для реализации целей:</p>
			<ul>
				<li>увеличение количества тестов с опытными инструкторами;</li>
				<li>участие в этапах Чемпионата и Кубка России по ралли;</li>
				<li>улучшение характеристик боевого автомобиля;</li>
				<li>повышение уровня сервиса, привлечение опытных механиков;</li>
				<li>приобретение автомобиля технического обеспечения;</li>
				<li>приобретение фото-/видео- аппаратуры для повышения качества контента в соц. сетях.</li>
			</ul>
			<p><b>Надеемся, что все это поможет нам достичь успеха в ралли и привлечь новых людей в этот вид автоспорта.</b></p>
		</div>
		<div class="col-lg-4 col-md-12 px-3">
			<img src="{{ asset('images/goals/image_1.jpg') }}" class="w-100 mb-5" />
			<img src="{{ asset('images/goals/image_2.jpg') }}" class="w-100" />
		</div>
	</div>
</div>

@endsection