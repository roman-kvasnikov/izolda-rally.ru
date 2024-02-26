@extends('layouts.base')

@section('title', 'Платеж'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Детали платежа</h1>
</div>

<div class="cart">

	<div class="card">
		<div class="card-body p-0">

			<ul class="list-group list-group-flush rounded-1">
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							ID платежа
						</div>
						<div class="col-8">
							{{ $payment->uuid }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Сумма платежа
						</div>
						<div class="col-8">
							{{ $payment->amount }} {{ $payment->currency_id }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Статус платежа
						</div>
						<div class="col-8 text-{{ $payment->status->color() }}">
							{{ $payment->status->name() }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-4 text-muted">
							Операция
						</div>
						<div class="col-8">
							{{ $payment->payable->getPayableName() }}
						</div>
					</div>
				</li>
			</ul>

		</div>

		<div class="card-footer">
			<div class="d-flex justify-content-between align-items-center p-2">
				<a href="/merch" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left px-2"></i> Назад к выбору</a>

				@if ($methods->isEmpty())
				<div class="text-center fs-5">Извините, оплата временно недоступна</div>
				@else
				<form action="{{ route('payments.method', $payment->uuid) }}" method="POST">
					@csrf

					<div class="d-flex justify-content-between align-items-center">
						<div class="mx-2">
							<select name="method_id" class="form-control">
								<option value="">Выберите способ оплаты</option>
								@foreach ($methods as $method)
								<option value="{{ $method->id }}">{{ $method->name }} ({{ $method->driver_currency_id }})</option>
								@endforeach
							</select>
						</div>
						<div class="mx-2">
							<button type="submit" class="btn btn-lg btn-primary px-5">Продолжить</button>
						</div>
					</div>
				</form>
				@endif

			</div>
		</div>
	</div>

</div>

@endsection