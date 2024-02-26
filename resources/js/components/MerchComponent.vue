<template>
	<div class="merch">

		<a href="/merch/cart" class="shopping-cart d-flex flex-column align-items-center text-decoration-none" title="В корзину">
			<i class="fa-solid fa-cart-shopping"></i>
			<span v-if="!this.cart_total_price">Корзина</span>
			<span v-else>{{ vueNumberFormat( this.cart_total_price ) }}</span>
			<span v-if="this.cart_total_items" class="is_added_to_cart bg-danger border border-1 border-danger rounded-circle text-white">{{ this.cart_total_items }}</span>
		</a>

		<div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-1 g-4 mb-4">

			<div v-if="!this.merch" class="text-center">
				Сорян, но на данный момент нихрена нет в продаже. Приходите чуть позже.
			</div>

			<div v-else v-for="merch in this.merch" :key="merch.id">

				<div class="card h-100">
					<img v-if="merch.image" :src="'/images/products/' + merch.image" class="card-img-top" :alt="merch.name" />
					<div class="card-body d-flex flex-column px-3 py-2">
						<h5 class="card-title">{{ merch.name }}</h5>
						<p class="card-text mb-auto">{{ merch.description }}</p>
						<p class="card-text mt-3 mb-0 fw-bold text-end">{{ vueNumberFormat( merch.price ) }}</p>
					</div>
					<div class="card-footer fs-5">
						<div v-if="!merch.quantity" class="text-danger text-center">Нет в наличии</div>
						<div v-else class="d-flex justify-content-between align-items-center">
							<small class="text-body-secondary">Всего: {{ merch.quantity }} шт.</small>
							<div class="add-to-cart d-flex justify-content-between align-items-center p-0">
								<input type="button" @click.prevent="this.add( merch.id )" value="+" class="btn fs-5 p-0" />
								<input type="text" :value="merch.cart_items" class="form-control text-center fs-5 p-0" disabled />
								<input type="button" @click.prevent="this.remove( merch.id )" value="-" class="btn fs-5 p-0" />
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

		<div class="d-flex justify-content-end align-items-center">
			<div class="pe-4">Итого: <strong>{{ vueNumberFormat( this.cart_total_price ) }}</strong></div>
			<a href="/merch/cart" class="btn btn-lg btn-primary px-5">В корзину</a>
		</div>

	</div>
</template>

<script>
import axios from 'axios';

export default {
	name: "MerchComponent",

	props:
	{
		merch: Array,
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
			this.merch.forEach( ( merch ) =>
			{
				if ( merch.id == id )
				{
					if ( merch.quantity > merch.cart_items )
					{
						axios
							.post( '/api/merch/cart/add', {
								merch_id: merch.id
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
			this.merch.forEach( ( merch ) =>
			{
				if ( merch.id == id )
				{
					if ( merch.cart_items > 0 )
					{
						axios
							.post( '/api/merch/cart/remove', {
								merch_id: merch.id
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
			this.merch.forEach( ( merch ) => merch.cart_items = 0 );

			this.cart_total_items = this.cart_total_price = 0;

			this.current_cart.forEach( ( cartItem ) =>
			{
				this.cart_total_items += cartItem.quantity;
				this.cart_total_price += cartItem.merch.price * cartItem.quantity;

				this.merch.find( element => element.id == cartItem.merch.id ).cart_items = cartItem.quantity;
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

.merch {
	position: relative;

	a.shopping-cart {
		position: absolute;
		top: -45px;
		right: 30px;

		font-size: 14px;

		i {
			font-size: 24px;
		}

		.is_added_to_cart {
			position: absolute;
			top: -10px;
			right: -5px;

			padding: 0 5px;

			font-size: 10px;
		}
	}

	.add-to-cart {
		input {
			width: 35px;
		}
	}
}
</style>