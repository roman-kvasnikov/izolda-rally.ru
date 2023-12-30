<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $data['subject'] }}</title>

	<style type="text/css">
		.ps {
			font-size: 12px;
			color: darkgrey;
			margin-top: 20px;
		}
	</style>
</head>

<body>
	<div class="message">{!! $data['message'] !!}</div>
	<div class="ps">Сообщение отправлено с официального сайта Izolda Rally</div>
</body>

</html>