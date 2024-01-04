<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" prefix="og: http://ogp.me/ns#">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', config('app.name'))</title>

	<meta name='ils:image' content="{{ asset('images/izolda.jpg') }}" />

	<meta property="og:title" content="Izolda Rally" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ config('app.url') }}" />
	<meta property="og:image" content="{{ asset('images/izolda.jpg') }}" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="Официальный сайт раллийной команды Izolda Rally" />

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

	@vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/bootstrap.js'])

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-NTCJG69JCE"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('js', new Date());

		gtag('config', 'G-NTCJG69JCE');
	</script>
</head>

<body>

	<div class="d-flex flex-column justify-content-between min-vh-100">

		@include('layouts.includes.header')

		<main class="main flex-grow-1">
			<div class="container">

				<div id="app" class="wrapper">
					@yield('content')
				</div>

			</div>
		</main>

		@include('layouts.includes.footer')

	</div>

</body>

</html>