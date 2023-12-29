@extends('layouts.base')

@section('title', 'Контакты')

@section('content')

<div class="title">
	<h1>Контакты</h1>
</div>

<div class="contacts">
	<div class="row gy-5 g-5">
		<div class="col-lg-6 col-md-12">
			<contact-form-component></contact-form-component>
		</div>
		<div class="col-lg-6 col-md-12">

			<div class="contacts-info">
				<!-- <div class="contacts-address">
					<div class="info-icon"><i class="fas fa-location-dot"></i></div>
					<div class="info-title">Адрес:</div>
					<div class="info-content">Россия, г. Выборг, ул. Большая Каменная д. 12</div>
				</div> -->
				<div class="contacts-phone">
					<div class="info-icon"><i class="fab fa-telegram"></i></div>
					<div class="info-title">Telegram:</div>
					<div class="info-content">
						<a href="https://t.me/romankw" class="btn btn-primary btn-telegram mx-3 my-2"><i class="fab fa-telegram"></i> Роман</a>
						<a href="https://t.me/balandini_motors" class="btn btn-primary btn-telegram mx-3 my-2"><i class="fab fa-telegram"></i> Илья</a>
					</div>
				</div>
				<div class="contacts-email">
					<div class="info-icon"><i class="fas fa-at"></i></div>
					<div class="info-title">E-Mail:</div>
					<div class="info-content">
						<a href="mailto:official@izolda-rally.ru" class="btn btn-link btn-mail mx-3 my-2">official@izolda-rally.ru</a>
						<a href="mailto:media@izolda-rally.ru" class="btn btn-link btn-mail mx-3 my-2">media@izolda-rally.ru</a>
					</div>
				</div>
			</div>

		</div>
		<!-- <div class="col-lg-4 col-md-12">
			<div class="contacts-info">
				<div class="contact d-flex flex-nowrap align-items-center">
					<div class="contact-photo" style="background-image: url('{{ asset('img/1_pilot.jpg') }}');"></div>
					<div class="contact-socials">
						<a href="https://t.me/izolda_rally" class="fa-brands fa-telegram" target="_blank"></a>
						<a href="https://t.me/izolda_rally" class="fa-brands fa-whatsapp" target="_blank"></a>
					</div>
				</div>

				<div class="contact d-flex flex-nowrap align-items-center">
					<div class="contact-photo" style="background-image: url('{{ asset('img/2_pilot.jpg') }}');"></div>
					<div class="contact-socials">
						<a href="https://t.me/izolda_rally" class="fa-brands fa-telegram" target="_blank"></a>
						<a href="https://t.me/izolda_rally" class="fa-brands fa-whatsapp" target="_blank"></a>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</div>

@endsection