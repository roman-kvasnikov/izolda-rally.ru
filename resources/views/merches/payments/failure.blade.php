@extends('layouts.base')

@section('title', 'Платеж'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Детали платежа</h1>
</div>

<div class="payment">

	<div class="card">
		<div class="card-body p-0">

			<div class="row align-items-top">

				<div class="col-12 p-2">
					<div class="text-danger text-center p-3">
						К сожалению, оплата не прошла!
					</div>
				</div>

			</div>

		</div>

		<div class="card-footer">
			<div class="row">
				<div class="col-xl-8 col-md-6 col-sm-6 align-self-center text-start px-0 py-2">
					<a href="/merches" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left pe-2"></i> Назад к выбору</a>
				</div>
				<div class="col-xl-4 col-md-6 col-sm-6 align-self-center text-end pe-2">
					<a href="{{ $payment->payable->getPayableUrl() }}" class="btn btn-lg btn-primary px-4">Продолжить</a>
				</div>
			</div>
		</div>

	</div>

</div>

@endsection