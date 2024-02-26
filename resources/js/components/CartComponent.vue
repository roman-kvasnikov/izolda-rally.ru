<template>
	<div class="cart">

		<div class="card">
			<div class="card-body">

				<div v-if="!this.cart_total_items" class="text-center fs-5 p-4">
					В корзину для начала надо хотя бы что-то добавить, чтобы тут что-то появилось. :)
				</div>
				<div v-else>
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
								<tr>
									<th class="text-center p-2" style="min-width: 190px">Мерч</th>
									<th class="text-center p-2" style="width: 130px">Цена</th>
									<th class="text-center p-2" style="width: 100px">Количество</th>
									<th class="text-center p-2" style="width: 130px">Итог</th>
									<th class="text-center px-0 py-2" style="width: 40px"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="cartItem in this.current_cart" :key="cart.id">
									<td class="p-3 align-middle">
										<div class="d-flex justify-content-start align-items-center">
											<img v-if="cartItem.merch.image" :src="'/images/products/' + cartItem.merch.image" class="card-img ui-w-150" :alt="cartItem.merch.name" />
											<div class="px-3">
												<h4>{{ cartItem.merch.name }}</h4>
												<p>{{ cartItem.merch.description }}</p>
											</div>
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ vueNumberFormat( cartItem.merch.price ) }}</td>
									<td class="text-center font-weight-semibold align-middle p-2">
										<div class="add-to-cart d-flex justify-content-between align-items-center">
											<input type="button" @click.prevent="this.add( cartItem.merch.id )" value="+" class="btn fs-5 p-0" />
											<input type="text" :value="cartItem.quantity" class="form-control text-center fs-5 p-0" disabled />
											<input type="button" @click.prevent="this.remove( cartItem.merch.id )" value="-" class="btn fs-5 p-0" />
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ vueNumberFormat( cartItem.merch.price * cartItem.quantity ) }}</td>
									<td class="text-center font-weight-semibold align-middle px-1">
										<a href="#" @click.prevent="this.removeAll( cartItem.merch.id )" class="remove_item_link" title="Удалить"><i class="fas fa-window-close"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>

			<div class="card-footer">
				<div class="d-flex justify-content-between align-items-center p-2">
					<a href="/merch" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left px-2"></i> Назад к выбору</a>

					<div class="d-flex justify-content-end align-items-center">
						<div class="pe-4">Итого: <strong>{{ vueNumberFormat( this.cart_total_price ) }}</strong></div>
						<a href="/merch/order/create" v-if="this.cart_total_items" type="button" class="btn btn-lg btn-primary px-5">Купить</a>
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
		cart: Array
	},

	data ()
	{
		return {
			current_cart: [],
			cart_total_items: 0,
			cart_total_price: 0
		}
	},

	beforeMount ()
	{
		this.current_cart = this.cart;

		this.calculate();
	},

	methods:
	{
		add ( id )
		{
			this.current_cart.forEach( ( cartItem ) =>
			{
				if ( cartItem.merch.id == id )
				{
					if ( cartItem.merch.quantity > cartItem.quantity )
					{
						axios
							.post( '/api/merch/cart/add', {
								merch_id: cartItem.merch.id
							} )
							.then( response =>
							{
								this.current_cart = response.data;

								this.calculate();
							} )
							.catch( error =>
							{
								console.log( error.response.data );
							} );

						return;

						this.$forceUpdate();
					}

					return;
				}
			} );
		},

		remove ( id )
		{
			this.current_cart.forEach( ( cartItem ) =>
			{
				if ( cartItem.merch.id == id )
				{
					if ( cartItem.quantity > 0 )
					{
						axios
							.post( '/api/merch/cart/remove', {
								merch_id: cartItem.merch.id
							} )
							.then( response =>
							{
								this.current_cart = response.data;

								this.calculate();
							} )
							.catch( error =>
							{
								console.log( error.response.data );
							} );

						return;

						this.$forceUpdate();
					}

					return;
				}
			} );
		},

		removeAll ( id )
		{
			this.current_cart.forEach( ( cartItem ) =>
			{
				if ( cartItem.merch.id == id )
				{
					if ( cartItem.quantity > 0 )
					{
						axios
							.post( '/api/merch/cart/remove/all', {
								merch_id: cartItem.merch.id
							} )
							.then( response =>
							{
								this.current_cart = response.data;

								this.calculate();
							} )
							.catch( error =>
							{
								console.log( error.response.data );
							} );

						return;

						this.$forceUpdate();
					}

					return;
				}
			} );
		},

		calculate ()
		{
			this.cart_total_items = this.cart_total_price = 0;

			this.current_cart.forEach( ( cartItem ) =>
			{
				this.cart_total_items += cartItem.quantity;
				this.cart_total_price += cartItem.merch.price * cartItem.quantity;
			} );

			return;
		}
	}
};
</script>

<style lang="scss" scoped>
@import '../../sass/import/fonts';
@import '../../sass/import/variables';
@import '../../sass/import/mixins';

@import 'bootstrap/scss/bootstrap';

.cart {
	box-shadow: 0 1px 15px 1px rgba(52, 40, 104, 0.08);

	.ui-w-150 {
		width: 150px !important;
		height: auto;
	}

	.remove_item_link {
		font-size: 25px;
	}

	.add-to-cart {
		input {
			width: 35px;
		}
	}
}
</style>