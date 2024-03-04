<template>
	<div class="products">
		<div v-if="activePage.list">
			<ProductsListComponent @goTo="onGoTo" />
		</div>
		<div v-else-if="activePage.cart">
			<ProductsCartComponent @goTo="onGoTo" />
		</div>
		<div v-else-if="activePage.order">
			<!-- <ProductsOrderComponent /> -->
		</div>
	</div>
</template>

<script>
import axios from 'axios';
axios.defaults.withCredentials = true;

import ProductsListComponent from './includes/ProductsListComponent.vue';
import ProductsCartComponent from './includes/ProductsCartComponent.vue';
import ProductsOrderComponent from './includes/ProductsOrderComponent.vue';

export default {
	name: "ProductsComponent",

	components:
	{
		ProductsListComponent,
		ProductsCartComponent,
		ProductsOrderComponent
	},

	props:
	{
		products: Array
	},

	data ()
	{
		return {
			activePage:
			{
				list: true,
				cart: false,
				order: false
			},
			addedProducts: null,
			added_to_cart: 0,
			total_price: 0
		}
	},

	beforeMount ()
	{
		this.products.forEach( ( product ) => product.added_items = 0 );
	},

	mounted ()
	{
		this.addedProducts = this.products;
	},

	methods:
	{
		addItem ( id )
		{
			this.products.forEach( ( product ) =>
			{
				if ( product.id == id )
				{
					if ( product.quantity > product.added_items )
					{
						product.added_items += 1;

						this.added_to_cart += 1;
						this.total_price += product.price;
					}

					return;
				}
			} );
		},

		removeItem ( id )
		{
			this.products.forEach( ( product ) =>
			{
				if ( product.id == id )
				{
					if ( product.added_items > 0 )
					{
						product.added_items -= 1;

						this.added_to_cart -= 1;
						this.total_price -= product.price;

						if ( product.added_items == 0 )
							this.addedProducts = this.products.filter( ( product ) => product.added_items > 0 );
					}

					return;
				}
			} );

			if ( this.added_to_cart == 0 )
				this.onGoTo( 'list' );
		},

		removeProduct ( id )
		{

			this.products.forEach( ( product ) =>
			{
				if ( product.id == id )
				{
					this.added_to_cart -= product.added_items;
					this.total_price -= product.added_items * product.price;

					product.added_items = 0;

					this.addedProducts = this.products.filter( ( product ) => product.added_items > 0 );

					return;
				}
			} );

			if ( this.added_to_cart == 0 )
				this.onGoTo( 'list' );
		},

		onGoTo ( page )
		{
			this.addedProducts = this.products.filter( ( product ) => product.added_items > 0 );

			axios
				.post( '/api/products', this.products )
				.then( response =>
				{
					console.log( response );
				} )
				.catch( error =>
				{
					console.log( error );
				} )
				.finally( response =>
				{
					console.log( response );
				} );

			if ( page == 'list' )
			{
				this.activePage.list = true;
				this.activePage.cart = false;
				this.activePage.order = false;
			}
			else if ( page == 'cart' )
			{
				this.activePage.list = false;
				this.activePage.cart = true;
				this.activePage.order = false;
			}
			else if ( page == 'order' )
			{
				this.activePage.list = false;
				this.activePage.cart = false;
				this.activePage.order = true;
			}
		}
	}
};
</script>

<style lang="scss" scoped></style>