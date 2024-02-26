@extends('layouts.base')

@section('title', 'Прием платежей'.' - '.config('app.name'))

@section('content')

<section>
	<div class="container">
		<div class="card p-3">
			<div class="cart-title">
				<h5>Тестовый платеж</h5>
			</div>
			<div class="cart-body">
				<p class="m-0">Вы можете подтвердить или отменить оплату в целях тестирования.</p>
			</div>
			<div class="row mt-4">
				<div class="col-6">
					<form action="{{ route('payments.complete', $payment->uuid) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-success btn-sm w-100">Подтвердить</button>
					</form>
				</div>
				<div class="col-6">
					<form action="{{ route('payments.cancel', $payment->uuid) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-danger btn-sm w-100">Отклонить</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection