@extends('layouts.base')

@section('title', 'Деятельность')

@section('content')

<div class="title">
	<h1>Деятельность</h1>
</div>

<div class="activity">
	<div class="row pb-4 g-4">
		<div class="col-lg-8 col-md-12 px-3">
			<p>Мы – раллийный экипаж, именуемый <b>Izolda Rally</b>. На данный момент являемся одним из самых медийных экипажей на просторах интернета в дисциплине ралли в России. С 2020 года выступаем ежегодно в Чемпионате и Кубке России по ралли.</p>
			<p><b>Ралли</b> – один из самых зрелищных видов автоспорта. Популярность этого вида спорта набирает обороты за счёт того, что в последние годы дисциплина активно освещается в СМИ и на просторах интернета, причём не только профессиональными журналистами, но и самими гоночными командами. Каждый этап ралли привлекает огромную аудиторию зрителей и болельщиков, и их количество постоянно растет.</p>
		</div>
		<div class="col-lg-4 col-md-12 px-3">
			<img src="{{ asset('img/activity/crew.jpg') }}" class="w-100" />
		</div>
	</div>
	<div class="row pb-5 g-4">
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_1.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_2.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_3.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_4.jpg') }}" class="w-100" />
		</div>
	</div>
	<div class="row pb-4 g-4">
		<div class="col-lg-3 col-md-12 px-3 ">
			<img src="{{ asset('img/activity/image_6.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-6 col-md-12 px-3">
			<p>Мы гордимся тем, что представляем ралли в России и стараемся сделать все возможное, чтобы привлечь ещё больше внимания к этому захватывающему виду спорта. Мы регулярно делимся своими успехами и впечатлениями через социальные сети, чтобы поддержать интерес и привлечь новых любителей этой дисциплины.</p>
			<p>В раллийном сообществе за нами закрепилось звание <b>"народного экипажа"</b>, во многом благодаря распространению через интернет записей онбордов (видео из салона во время соревнований).</p>
			<p>Мы представляем команду, которая не только стремится достичь успеха на соревнованиях, но и близко взаимодействует с фанатами. Мы считаем, что только таким образом можно развивать ралли в России и повышать его популярность среди всех любителей автоспорта.</p>
		</div>
		<div class="col-lg-3 col-md-12 px-3">
			<img src="{{ asset('img/activity/image_9.jpg') }}" class="w-100" />
		</div>
	</div>
	<div class="row pb-5 g-4">
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_5.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_10.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_7.jpg') }}" class="w-100" />
		</div>
		<div class="col-lg-3 col-md-6">
			<img src="{{ asset('img/activity/image_8.jpg') }}" class="w-100" />
		</div>
	</div>
	<div class="row g-4">
		<div class="col-lg-12 col-md-12 px-3">
			<p>Слаженность действий, профессиональные умения, но, в то же время, живое взаимодействие и много харизмы - все эти качества сплотили вокруг нас огромное сообщество людей из разных уголков страны. Мы искренне надеемся, что наша работа поможет ралли стать еще более популярным и привлечет еще больше людей к этому увлекательному виду спорта. Мы хотим, чтобы радость и адреналин ралли были доступны каждому, поэтому мы уделяем особое внимание коммуникации и взаимодействию с нашей аудиторией.</p>
		</div>
	</div>
</div>

@endsection