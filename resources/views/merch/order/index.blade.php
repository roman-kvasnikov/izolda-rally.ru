@extends('layouts.base')

@section('title', 'Заказ'.' - '.config('app.name'))

@section('content')

<div class="title">
	<h1>Детали заказа</h1>
</div>

<div class="cart">

	<div class="card mb-3">
		<div class="card-body p-0">

			<ul class="list-group list-group-flush rounded-1">
				<li class="list-group-item">
					<div class="row">
						<div class="col-3 text-muted">
							ID заказа
						</div>
						<div class="col-9">
							{{ $order->uuid }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-3 text-muted">
							Сумма заказа
						</div>
						<div class="col-9">
							{{ money(convert( $order->amount ), currency()) }}
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-3 text-muted">
							Статус заказа
						</div>
						<div class="col-9 text-{{ $order->status->color() }}">
							{{ $order->status->name() }}
						</div>
					</div>
				</li>
			</ul>

		</div>
	</div>

	<div class="card">
		<form action="{{ route('orders.payment', $order->uuid) }}" method="POST">
			@csrf

			<div class="card-body p-0">

				<ul class="list-group list-group-flush rounded-1">
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-3 text-muted">
								Ваше полное имя:
							</div>
							<div class="col-9">
								<input type="text" name="full_name" value="{{ old('full_name') ? old('full_name') : $order->full_name }}" class="form-control @error('full_name') is-invalid @enderror">
								<div class="invalid-feedback">
									@error('full_name')
									{{ $message }}
									@enderror
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-3 text-muted">
								Ваш E-Mail:
							</div>
							<div class="col-9">
								<input type="text" name="email" value="{{ old('email') ? old('email') : $order->email }}" class="form-control @error('email') is-invalid @enderror">
								<div class="invalid-feedback">
									@error('email')
									{{ $message }}
									@enderror
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-3 text-muted">
								Ваш номер телефона:
							</div>
							<div class="col-9">
								<input type="tel" name="phone" value="{{ old('phone') ? old('phone') : $order->phone }}" class="form-control @error('phone') is-invalid @enderror phone">
								<div class="invalid-feedback">
									@error('phone')
									{{ $message }}
									@enderror
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-3 text-muted">
								Ваш город:
							</div>
							<div class="col-9">
								<input type="text" name="city" value="{{ old('city') ? old('city') : $order->city }}" class="form-control @error('city') is-invalid @enderror">
								<div class="invalid-feedback">
									@error('city')
									{{ $message }}
									@enderror
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-3 text-muted">
								Примечания к заказу:
							</div>
							<div class="col-9">
								<textarea name="note" value="{{ old('note') ? old('note') : $order->note }}" class="form-control @error('note') is-invalid @enderror"></textarea>
								<div class="invalid-feedback">
									@error('note')
									{{ $message }}
									@enderror
								</div>

							</div>
						</div>
					</li>
				</ul>

			</div>

			<div class="card-footer">

				<div class="d-flex justify-content-between align-items-center p-2">
					<a href="/merch" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left px-2"></i> Назад к выбору</a>

					@if ($order->status->isPending())
					<div>
						<button type="submit" class="btn btn-lg btn-primary px-5">Перейти к оплате</button>
					</div>
					@endif
				</div>

			</div>
		</form>
	</div>

</div>

@vite(['resources/js/input_mask.js'])

@endsection