<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: http://ogp.me/ns#">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=730, initial-scale=1.0"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') - Izolda Rally</title>

	<meta name='ils:image' content="{{ asset('img/izolda.jpg') }}" />

	<meta property="og:title" content="Izolda Rally" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ env('APP_URL') }}" />
	<meta property="og:image" content="{{ asset('img/izolda.jpg') }}" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="Сайт раллийной команды Izolda Rally" />

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

	@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/bootstrap.js'])
</head>

<body>

	<header class="fixed-top text-white border-bottom py-2">
		<div class="container">
			<div class="row">
				<div class="col">
					<nav class="navbar navbar-expand-md navbar-dark d-flex align-items-center">
						<div style="width: 150px;">
							<a href="{{ route('index') }}">
								<img src="{{ asset('img/izolda_logo.png') }}" class="img-fluid w-100" />
							</a>
						</div>

						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="navbar-collapse collapse justify-content-end" id="collapsibleNavbar">
							<ul class="navbar-nav nav-pills">
								<li class="nav-item"><a href="{{ route('index') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('index') ? 'active' : '' }}">Главная</a></li>
								<li class="nav-item"><a href="{{ route('crew') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('crew') ? 'active' : '' }}">Экипаж</a></li>
								<li class="nav-item"><a href="{{ route('team') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('team') ? 'active' : '' }}">Команда</a></li>
								<li class="nav-item"><a href="{{ route('activity') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('activity') ? 'active' : '' }}">Деятельность</a></li>
								<li class="nav-item"><a href="{{ route('tech') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('tech') ? 'active' : '' }}">Техника</a></li>
								<li class="nav-item"><a href="{{ route('goals') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('goals') ? 'active' : '' }}">Цели</a></li>
								<li class="nav-item"><a href="{{ route('contacts') }}" class="nav-link px-2 mx-1 {{ Request::url() == route('contacts') ? 'active' : '' }}">Контакты</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>

	<main class="main">
		<div class="container">

			<div id="app" class="wrapper">
				@yield('content')
			</div>

		</div>
	</main>

	<footer class="fixed-bottom text-white border-top py-4">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<p class="my-2">&copy;&nbsp;<?php echo date('Y', time()) ?>&nbsp;Izolda&nbsp;Rally</p>
				</div>
				<div class="col-8">
					<ul class="nav d-flex justify-content-end">
						<li class="ms-3">
							<a href="https://vk.com/izolda_rally" class="fa-brands fa-vk" target="_blank"></a>
						</li>
						<li class="ms-3">
							<a href="https://t.me/izolda_rally" class="fa-brands fa-telegram" target="_blank"></a>
						</li>
						<li class="ms-3">
							<a href="https://www.youtube.com/@IzoldaRally" class="fa-brands fa-youtube" target="_blank"></a>
						</li>
						<li class="ms-3">
							<a href="https://instagram.com/izolda_rally" class="fa-brands fa-instagram" target="_blank"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>

</body>

</html>