<template>
	<div class="payment">

		<div class="card mb-3">
			<div class="card-body p-0">

				<ul class="list-group list-group-flush rounded-2">
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								ID платежа:
							</div>
							<div class="col-7">
								{{ payment_data.uuid }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								Сумма платежа:
							</div>
							<div class="col-7">
								{{ payment_data.amount.formatted }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								Статус платежа:
							</div>
							<div :class="'col-7 text-' + payment_data.status.color">
								{{ payment_data.status.name }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								Операция:
							</div>
							<div class="col-7">
								{{ payment_data.payable.name }}
							</div>
						</div>
					</li>
				</ul>

			</div>

		</div>

		<div class="card">
			<div class="card-body p-0">

				<div class="row align-items-top">

					<div class="col-12 p-2">
						<div v-if="!methods" class="text-danger text-center p-3">
							Извините, оплата временно недоступна
						</div>
						<div v-else class="row align-items-center m-2">
							<div class="col-5 text-muted text-end p-0">
								Выберите способ оплаты:
							</div>
							<div class="col-4">
								<select name="method_id" class="form-select" v-model="payment_data.method.id" :class="[ payment_data_errors.method_id ? 'is-invalid' : '' ]">
									<option disabled value=""></option>
									<option v-for="method in methods" :key="method.id" :value='method.id'>{{ method.name }} ({{ method.driver_currency_id }})</option>
								</select>
								<div class="invalid-feedback" v-if="payment_data_errors.method_id">
									{{ payment_data_errors.method_id[ 0 ] }}
								</div>
							</div>
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
						<a href="#" @click.prevent="ToProceed" class="btn btn-lg btn-primary px-4">
							<i v-if="is_loading" class="fas fa-spinner fa-spin text-center"></i>
							<span v-else>Продолжить</span>
						</a>
					</div>
				</div>
			</div>

		</div>

	</div>
</template>

<script>
import axios from 'axios';

export default {
	name: "PaymentsComponent",

	props:
	{
		payment: Object,
		methods: Object
	},

	data ()
	{
		return {
			payment_data: this.payment,
			payment_data_errors: {},

			is_loading: false
		}
	},

	methods: {
		ToProceed ()
		{
			this.is_loading = true;

			axios
				.post( '/api/merches/payments/' + this.payment.uuid + '/method', { method_id: this.payment_data.method.id } )
				.then( response =>
				{
					this.payment_data_errors = {};

					window.location.href = '/merches/payments/' + response.data + '/process';
				} )
				.catch( error =>
				{
					if ( error.response.status === 422 )
						this.payment_data_errors = error.response.data.errors;

					this.is_loading = false;
				} );
		}
	}
};
</script>