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
								<input type="text" autocomplete="on" class="form-control" v-model="order_data.last_name" :class="[ order_data_errors.last_name ? 'is-invalid' : '' ]">
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
								<input type="text" autocomplete="on" class="form-control" v-model="order_data.first_name" :class="[ order_data_errors.first_name ? 'is-invalid' : '' ]">
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
								<input type="text" autocomplete="on" class="form-control" v-model="order_data.middle_name" :class="[ order_data_errors.middle_name ? 'is-invalid' : '' ]">
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
								<input type="text" autocomplete="on" class="form-control" v-model="order_data.email" :class="[ order_data_errors.email ? 'is-invalid' : '' ]">
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
								<input id="postal_code" name="postal_code" type="text" v-model="order_data.postal_code" />
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
								<input id="region" name="region" type="text" v-model="order_data.region" />
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
								<input id="city" name="city" type="text" />
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
								<input id="street" name="street" type="text" />
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
								<input type="text" autocomplete="on" class="form-control" v-model="order_data.cdek_address" :class="[ order_data_errors.cdek_address ? 'is-invalid' : '' ]">
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

export default {
	name: "OrdersComponent",

	props:
	{
		order: Object
	},

	data ()
	{
		return {
			order_data: this.order,
			order_data_errors: {},

			is_loading: false,
		}
	},

	mounted ()
	{
		$( document ).ready( function ()
		{
			var token = "cd1c311a320ddd9809fc52aafe633684ea12ae58";

			var type = "ADDRESS";

			var $postal_code = $( "#postal_code" );
			var $region = $( "#region" );
			var $city = $( "#city" );
			var $street = $( "#street" );

			$postal_code.suggestions( {
				token: token,
				type: type,
				hint: false,
				formatResult: formatResult,
				formatSelected: formatSelected,
				onSelect: showSelected
			} );

			$region.suggestions( {
				token: token,
				type: type,
				hint: false,
				bounds: "region-area"
			} );

			$city.suggestions( {
				token: token,
				type: type,
				hint: false,
				bounds: "city-settlement",
				constraints: $region
			} );

			$street.suggestions( {
				token: token,
				type: type,
				hint: false,
				bounds: "street-flat",
				constraints: $city
			} );

			function join ( arr /*, separator */ )
			{
				var separator = arguments.length > 1 ? arguments[ 1 ] : ", ";
				return arr.filter( function ( n ) { return n } ).join( separator );
			}

			function showSelected ( suggestion )
			{
				var address = suggestion.data;

				showPostalCode( address );
				showRegion( address );
				showCity( address );
				showStreet( address );
			}

			function showPostalCode ( address )
			{
				$postal_code.val( join( [
					join( [ address.postal_code ], " " )
				] ) );
			}

			function showRegion ( address )
			{
				$region.val( join( [
					join( [ address.region, address.region_type ], " " ),
					join( [ address.area, address.area_type ], " " )
				] ) );
			}

			function showCity ( address )
			{
				$city.val( join( [
					join( [ address.city_type, address.city ], " " ),
					join( [ address.settlement_type, address.settlement ], " " )
				] ) );
			}

			function showStreet ( address )
			{
				$street.val(
					join( [ address.street_type, address.street ], " " ),
					join( [ address.house_type, address.house ], " " ),
					join( [ address.block_type, address.block ], " " ),
					join( [ address.flat_type, address.flat ], " " )
				);
			}

			function formatResult ( value, currentValue, suggestion )
			{
				var addressValue = makeAddressString( suggestion.data );
				return addressValue;
			}

			function formatSelected ( suggestion )
			{
				var addressValue = makeAddressString( suggestion.data );
				suggestion.value = addressValue;
				return addressValue;
			}

			function makeAddressString ( address )
			{
				return join( [
					join( [ address.postal_code ], " " )
				] );
			}
		} );
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
	}
};
</script>