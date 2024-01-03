@extends('layouts.base')

@section('title', 'Контакты'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Контакты</h1>
</div>

<div class="contacts">
	<div class="row gy-5 gx-5">
		<div class="col-lg-7 col-md-12">
			<contact-form-component></contact-form-component>
		</div>
		<div class="col-lg-5 col-md-12">

			<div class="contacts-info">
				<div class="contacts-telegram">
					<div class="info-icon"><i class="fab fa-telegram"></i></div>
					<div class="info-title">Personal Telegram:</div>
					<div class="info-content">
						<a href="https://t.me/romankw" target="_blank" class="btn btn-primary btn-telegram mx-3 my-2"><i class="fab fa-telegram"></i> Роман</a>
						<a href="https://t.me/balandini_motors" target="_blank" class="btn btn-primary btn-telegram mx-3 my-2"><i class="fab fa-telegram"></i> Илья</a>
					</div>
				</div>
				<div class="contacts-email">
					<div class="info-icon"><i class="fas fa-at"></i></div>
					<div class="info-title">Official E-Mails:</div>
					<div class="info-content">
						<a href="mailto:official@izolda-rally.ru" target="_blank">official@izolda-rally.ru</a><br/>
						<a href="mailto:media@izolda-rally.ru" target="_blank">media@izolda-rally.ru</a>
					</div>
				</div>
				<div class="contacts-vk">
					<div class="info-icon"><i class="fab fa-vk"></i></div>
					<div class="info-title">Вконтакте:</div>
					<div class="info-content">
						<a href="https://vk.com/izolda_rally" target="_blank">https://vk.com/izolda_rally</a>
					</div>
				</div>
				<div class="contacts-telegram">
					<div class="info-icon"><i class="fab fa-telegram"></i></div>
					<div class="info-title">Telegram:</div>
					<div class="info-content">
						<a href="https://t.me/izolda_rally" target="_blank">https://t.me/izolda_rally</a>
					</div>
				</div>
				<div class="contacts-youtube">
					<div class="info-icon"><i class="fab fa-youtube"></i></div>
					<div class="info-title">YouTube:</div>
					<div class="info-content">
						<a href="https://youtube.com/@IzoldaRally" target="_blank">https://youtube.com/@IzoldaRally</a>
					</div>
				</div>
				<!-- <div class="contacts-instagram">
					<div class="info-icon"><i class="fab fa-instagram"></i></div>
					<div class="info-title">Instagram:</div>
					<div class="info-content">
						<a href="https://instagram.com/izolda_rally" target="_blank">https://instagram.com/izolda_rally</a>
					</div>
				</div> -->
			</div>

		</div>
	</div>
</div>

@endsection