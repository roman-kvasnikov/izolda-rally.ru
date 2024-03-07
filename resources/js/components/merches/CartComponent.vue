<template>
	<div class="cart">

		<div class="card">
			<div class="card-body">

				<div v-if="!cart_data.total_items" class="text-danger text-center p-3">
					В корзину для начала надо хотя бы что-то добавить, чтобы тут что-то появилось. :)
				</div>

				<div v-else>

					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
								<tr>
									<th class="text-center p-2" style="min-width: 600px">Мерч</th>
									<th class="text-center p-2" style="min-width: 100px">Цена</th>
									<th class="text-center p-2" style="min-width: 100px">Количество</th>
									<th class="text-center p-2" style="min-width: 100px">Итог</th>
									<th class="text-center px-0 py-2" style="min-width: 40px"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="cartItem in cart_data.items" :key="cart_data.items.id">
									<td class="p-2 align-middle">
										<div class="d-flex justify-content-start p-0">
											<img v-if="cartItem.merch.image" :src="cartItem.merch.image" class="card-img ui-w-150" :alt="cartItem.merch.name" />
											<div class="ps-3 flex-fill d-flex flex-column mh-100">
												<h4>{{ cartItem.merch.name }}</h4>
												<p>{{ cartItem.merch.description }}</p>
												<p class="text-muted text-end m-0 p-0 mt-auto">Всего: {{ cartItem.merch.quantity }} шт.</p>
											</div>
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ cartItem.merch.price.formatted }}</td>
									<td class="text-center font-weight-semibold align-middle p-2">
										<div class="add-to-cart d-flex justify-content-between align-items-center">
											<input type="button" @click.prevent="add( cartItem.merch.id )" value="+" class="btn fs-5 p-0" />

											<i v-if="cartItem.is_loading" class="is_loading fas fa-spinner fa-spin text-center"></i>
											<input v-else type="text" :value="cartItem.quantity" class="form-control text-center fs-5 p-0" disabled />

											<input type="button" @click.prevent="remove( cartItem.merch.id )" value="-" class="btn fs-5 p-0" />
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ cartItem.merch.total_price.formatted }}</td>
									<td class="text-center font-weight-semibold align-middle px-1">
										<a href="#" @click.prevent="remove( cartItem.merch.id, true )" class="remove_item_link" title="Удалить"><i class="fas fa-window-close"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>

			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-xl-3 col-md-4 col-sm-4 align-self-center text-start px-0 py-2">
						<a href="/merches" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left pe-2"></i> Назад к выбору</a>
					</div>
					<div v-if="cart_data.total_items" class="col-xl-7 col-md-4 col-sm-3 align-self-center text-end pe-3 py-2">
						Итого: <strong>{{ cart_data.total_price.formatted }}</strong>
					</div>
					<div v-if="cart_data.total_items" class="col-xl-2 col-md-4 col-sm-5 align-self-center text-end pe-2">
						<a href="/merches/orders/create" class="btn btn-lg btn-primary px-5">Купить</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
import axios from 'axios';

export default {
	name: "CartComponent",

	props:
	{
		cart: Object
	},

	data ()
	{
		return {
			cart_data: this.cart
		}
	},

	methods:
	{
		add ( id )
		{
			let cartItem = this.cart_data.items.find(
				( cartItem ) => cartItem.merch.id === id && cartItem.quantity < cartItem.merch.quantity
			);

			return cartItem ? this.action( '/api/merches/cart/add', { merch_id: cartItem.merch.id }, cartItem ) : false;
		},

		remove ( id, total = false )
		{
			let cartItem = this.cart_data.items.find(
				( cartItem ) => cartItem.merch.id === id && cartItem.quantity > 0
			);

			return cartItem ? this.action( '/api/merches/cart/remove', { merch_id: cartItem.merch.id, total }, cartItem ) : false;
		},

		action ( url, data, cartItem )
		{
			cartItem.is_loading = true;

			this.$forceUpdate();

			axios
				.post( url, data )
				.then( response =>
				{
					this.cart_data = response.data;

					cartItem.is_loading = false;

					return true;
				} )
				.catch( error =>
				{
					console.log( error.response.data );

					cartItem.is_loading = false;

					return false;
				} );
		}
	}
};
</script>