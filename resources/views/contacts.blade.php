@extends('layouts.base')

@section('title', 'Контакты')

@section('content')

<div class="title">
	<h1>Контакты</h1>
</div>

<div class="contacts">
	<div class="row gy-5 g-5">
		<div class="col-lg-2 col-md-12">

		</div>
		<div class="col-lg-8 col-md-12">
			<contact-form-component></contact-form-component>
		</div>
		<div class="col-lg-2 col-md-12">

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