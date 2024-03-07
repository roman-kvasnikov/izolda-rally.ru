<template>
	<div class="merches">

		<a href="/merches/cart" class="shopping-cart d-flex flex-column align-items-center text-decoration-none" title="В корзину">
			<i class="fa-solid fa-cart-shopping"></i>
			<span v-if="!cart_data.total_price.value">Корзина</span>
			<span v-else>{{ cart_data.total_price.formatted }}</span>
			<span v-if="cart_data.total_items" class="is_added_to_cart bg-danger border border-1 border-danger rounded-circle text-white">{{ cart_data.total_items }}</span>
		</a>

		<div class="card">
			<div class="card-body">

				<div v-if="merches.length == 0" class="text-danger text-center p-3">
					Сорян, но на данный момент нихрена нет в продаже. Приходите чуть позже.
				</div>

				<div v-else class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1 g-3">

					<div v-for="merch in merches" :key="merches.id">

						<div class="card h-100">
							<img v-if="merch.image" :src="merch.image" class="card-img-top" :alt="merch.name" />
							<div class="card-body d-flex flex-column px-3 py-2">
								<h5 class="card-title">{{ merch.name }}</h5>
								<p class="card-text mb-auto">{{ merch.description }}</p>
								<p class="card-text mt-3 mb-0 fw-bold text-end">{{ merch.price.formatted }}</p>
							</div>
							<div class="card-footer fs-5">
								<div v-if="!merch.quantity" class="text-danger text-center">Нет в наличии</div>
								<div v-else class="d-flex justify-content-between align-items-center">
									<small class="text-body-secondary">Всего: {{ merch.quantity }} шт.</small>
									<div class="add-to-cart d-flex justify-content-between align-items-center p-0">
										<input type="button" @click.prevent="add( merch.id )" value="+" class="btn fs-5 p-0" />

										<i v-if="merch.is_loading" class="is_loading fas fa-spinner fa-spin text-center"></i>
										<input v-else type="text" :value="merch.cart_items" class="form-control text-center fs-5 p-0" disabled />

										<input type="button" @click.prevent="remove( merch.id )" value="-" class="btn fs-5 p-0" />
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-xl-10 col-lg-9 col-sm-8 align-self-center text-end py-2">
						Итого: <strong>{{ cart_data.total_price.formatted }}</strong>
					</div>
					<div class="col-xl-2 col-lg-3 col-sm-4 align-self-center text-end">
						<a href="/merches/cart" class="btn btn-lg btn-primary px-4">В&nbsp;корзину</a>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
import axios from 'axios';

export default {
	name: "MerchesComponent",

	props:
	{
		merches: Object,
		cart: Object
	},

	data ()
	{
		return {
			cart_data: this.cart,
		}
	},

	beforeMount ()
	{
		this.calculate();
	},

	methods:
	{
		add ( id )
		{
			let merch = this.merches.find(
				( merch ) => merch.id === id && merch.quantity > merch.cart_items
			);

			return merch ? this.action( '/api/merches/cart/add', { merch_id: merch.id }, merch ) : false;
		},

		remove ( id )
		{
			let merch = this.merches.find(
				( merch ) => merch.id === id && merch.cart_items > 0
			);

			return merch ? this.action( '/api/merches/cart/remove', { merch_id: merch.id }, merch ) : false;
		},

		action ( url, data, merch )
		{
			merch.is_loading = true;

			this.$forceUpdate();

			axios
				.post( url, data )
				.then( response =>
				{
					this.cart_data = response.data;

					this.calculate();

					merch.is_loading = false;

					return true;
				} )
				.catch( error =>
				{
					console.log( error.response.data );

					merch.is_loading = false;

					return false;
				} );
		},

		calculate ()
		{
			this.merches.forEach(
				( merch ) => merch.cart_items = 0
			);

			this.cart_data.items.forEach( ( item ) =>
				this.merches.find(
					element => element.id == item.merch.id
				).cart_items = item.quantity
			);

			return;
		}
	}
};
</script>