<template>

	<div class="order">

		<div class="card">
			<div class="card-body p-0">

				<ul class="list-group list-group-flush rounded-2">
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								ID заказа:
							</div>
							<div class="col-7">
								{{ order_data.uuid }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								Сумма заказа:
							</div>
							<div class="col-7">
								{{ order_data.amount.formatted }}
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row align-items-center">
							<div class="col-5 text-muted text-end">
								Статус заказа:
							</div>
							<div :class="'col-7 text-' + order_data.status.color">
								{{ order_data.status.name }}
							</div>
						</div>
					</li>
				</ul>

			</div>
		</div>

		<div class="card mt-3">
			<div v-if="order_data.status.is_pending" class="card-body p-0">

				<div class="row align-items-top">
					<div class="col-lg-6 col-md-12 p-2">

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Фамилия:
							</div>
							<div class="col-8">
								<dadata-component type="fio" :autocomplete="true" v-model="order_data.last_name" :is_error="order_data_errors.last_name ? true : false" />
								<div v-if="order_data_errors.last_name" class="invalid-feedback">
									{{ order_data_errors.last_name[ 0 ] }}
								</div>
							</div>
						</div>

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Имя:
							</div>
							<div class="col-8">
								<dadata-component type="fio" :autocomplete="true" v-model="order_data.first_name" :is_error="order_data_errors.first_name ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.first_name">
									{{ order_data_errors.first_name[ 0 ] }}
								</div>
							</div>
						</div>

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Отчество:
							</div>
							<div class="col-8">
								<dadata-component type="fio" :autocomplete="true" v-model="order_data.middle_name" :is_error="order_data_errors.middle_name ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.middle_name">
									{{ order_data_errors.middle_name[ 0 ] }}
								</div>
							</div>
						</div>

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								E-Mail:
							</div>
							<div class="col-8">
								<dadata-component type="email" :autocomplete="true" v-model="order_data.email" :is_error="order_data_errors.email ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.email">
									{{ order_data_errors.email[ 0 ] }}
								</div>
							</div>
						</div>

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Телефон:
							</div>
							<div class="col-8">
								<input type="tel" autocomplete="on" class="form-control" v-model="order_data.phone" v-mask="'+7 (###) ###-##-##'" :class="[ order_data_errors.phone ? 'is-invalid' : '' ]">
								<div class="invalid-feedback" v-if="order_data_errors.phone">
									{{ order_data_errors.phone[ 0 ] }}
								</div>
							</div>
						</div>

					</div>

					<div class="col-lg-6 col-md-12 p-2">

						<div class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Способ доставки:
							</div>
							<div class="col-8">
								<select class="form-select" v-model="order_data.delivery_method" :class="[ order_data_errors.delivery_method ? 'is-invalid' : '' ]">
									<option disabled value=""></option>
									<option value="cdek">СДЭК</option>
									<option value="pochta">Почта России</option>
								</select>
								<div class="invalid-feedback" v-if="order_data_errors.delivery_method">
									{{ order_data_errors.delivery_method[ 0 ] }}
								</div>
							</div>
						</div>

						<div v-if="order_data.delivery_method == 'pochta'" class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Индекс:
							</div>
							<div class="col-8">
								<!-- <input type="text" autocomplete="on" class="form-control" :autocomplete="true" v-model="order_data.postal_code" v-mask="'######'" :class="[ order_data_errors.postal_code ? 'is-invalid' : '' ]"> -->
								<dadata-component type="address" :autocomplete="true" v-model="order_data.postal_code" v-model:suggestion="suggestions.postal_code" v-mask="'######'" :is_error="order_data_errors.postal_code ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.postal_code">
									{{ order_data_errors.postal_code[ 0 ] }}
								</div>
							</div>
						</div>

						<div v-if="order_data.delivery_method == 'pochta'" class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Регион:
							</div>
							<div class="col-8">
								<dadata-component type="address" :fromBound="'region'" :toBound="'area'" :autocomplete="true" v-model="order_data.region" v-model:suggestion="suggestions.region" :is_error="order_data_errors.region ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.region">
									{{ order_data_errors.region[ 0 ] }}
								</div>
							</div>
						</div>

						<div v-if="order_data.delivery_method == 'pochta' || order_data.delivery_method == 'cdek'" class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Город:
							</div>
							<div class="col-8">
								<dadata-component type="address" :fromBound="'city'" :toBound="'settlement'" :locationOptions="{ locations: [ { 'region': Object.keys( suggestions.region ).length !== 0 ? suggestions.region.data.region : '' } ] }" :autocomplete="true" v-model="order_data.city" v-model:suggestion="suggestions.city" :is_error="order_data_errors.city ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.city">
									{{ order_data_errors.city[ 0 ] }}
								</div>
							</div>
						</div>

						<div v-if="order_data.delivery_method == 'pochta'" class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Адрес:
							</div>
							<div class="col-8">
								<dadata-component type="address" :fromBound="'street'" :toBound="'flat'" :locationOptions="{ locations: [ { 'city': Object.keys( suggestions.city ).length !== 0 ? suggestions.city.data.city : '' } ] }" :autocomplete="true" v-model="order_data.address" :is_error="order_data_errors.address ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.address">
									{{ order_data_errors.address[ 0 ] }}
								</div>
							</div>
						</div>

						<div v-if="order_data.delivery_method == 'cdek'" class="row align-items-center m-2">
							<div class="col-4 text-muted text-end p-0">
								Адрес СДЭК:
							</div>
							<div class="col-8">
								<dadata-component type="address" :fromBound="'street'" :toBound="'street'" :locationOptions="{ city: order_data.city }" :autocomplete="true" v-model="order_data.cdek_address" :is_error="order_data_errors.cdek_address ? true : false" />
								<div class="invalid-feedback" v-if="order_data_errors.cdek_address">
									{{ order_data_errors.cdek_address[ 0 ] }}
								</div>
							</div>
						</div>

					</div>

					<div class="col-12 p-2">
						<div class="row align-items-center m-2">
							<div class="col-12 text-muted text-start p-3">
								Примечание:
							</div>
							<div class="col-12">
								<textarea autocomplete="on" rows="4" class="form-control" v-model="order_data.note" :class="[ order_data_errors.note ? 'is-invalid' : '' ]"></textarea>
								<div class="invalid-feedback" v-if="order_data_errors.note">
									{{ order_data_errors.note[ 0 ] }}
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

			<div class="card-footer" :class="[ !order_data.status.is_pending ? 'border-0' : '' ]">
				<div class="row">
					<div class="col-xl-8 col-md-6 col-sm-6 align-self-center text-start px-0 py-2">
						<a href="/merches" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left pe-2"></i> Назад к выбору</a>
					</div>
					<div v-if="order_data.status.is_pending" class="col-xl-4 col-md-6 col-sm-6 align-self-center text-end pe-2">
						<a href="#" @click.prevent="ToPayment" class="btn btn-lg btn-primary px-4">
							<i v-if="is_loading" class="fas fa-spinner fa-spin text-center"></i>
							<span v-else>Перейти&nbsp;к&nbsp;оплате</span>
						</a>
					</div>
				</div>
			</div>

		</div>

	</div>

</template>

<script>
import axios from 'axios';
import DadataComponent from '../includes/DadataComponent.vue';

export default {
	name: "OrdersComponent",

	components: {
		DadataComponent
	},

	props:
	{
		order: Object
	},

	data ()
	{
		return {
			order_data: this.order,
			suggestions: {
				postal_code: [],
				region: [],
				city: [],
				address: []
			},
			order_data_errors: {},

			is_loading: false,
		}
	},

	methods: {
		ToPayment ()
		{
			this.is_loading = true;

			axios
				.post( '/api/merches/orders/' + this.order.uuid + '/payment', this.order_data )
				.then( response =>
				{
					this.order_data_errors = {};

					window.location.href = '/merches/payments/' + response.data + '/checkout';
				} )
				.catch( error =>
				{
					if ( error.response.status === 422 )
						this.order_data_errors = error.response.data.errors;

					this.is_loading = false;
				} );
		}
	},

	created ()
	{
		this.$watch( () => this.suggestions.postal_code, () =>
		{
			console.log( this.suggestions.postal_code );

			this.order_data.region = this.suggestions.postal_code.data.region_with_type; // нужно событие выбора
			this.order_data.city = this.suggestions.postal_code.data.city_with_type;
			this.order_data.address = this.suggestions.postal_code.data.text;
		} )
	}
};
</script>