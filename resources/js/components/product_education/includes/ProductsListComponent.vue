<template>
	<div class="products_list">
		<a href="#" @click.prevent="goTo( 'cart' )" class="shopping-cart d-flex flex-column align-items-center text-decoration-none" title="В корзину">
			<i class="fa-solid fa-cart-shopping"></i>
			<span v-if="!this.$parent.total_price">Корзина</span>
			<span v-else>{{ vueNumberFormat( this.$parent.total_price ) }}</span>
			<span v-if="this.$parent.added_to_cart" class="is_added_to_cart bg-danger border border-1 border-danger rounded-circle text-white">{{ this.$parent.added_to_cart }}</span>
		</a>

		<div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-1 g-4">
			<div v-if="!this.$parent.products" class="text-center">
				Нет ни одного продукта
			</div>
			<div v-else v-for="product in this.$parent.products" :key="product.id">
				<div class="card h-100">
					<img v-if="product.image" :src="'/images/products/' + product.image" class="card-img-top" :alt="product.name" />
					<div class="card-body d-flex flex-column px-3 py-2">
						<h5 class="card-title">{{ product.name }}</h5>
						<p class="card-text mb-auto">{{ product.description }}</p>
						<p class="card-text mt-3 mb-0 fw-bold text-end">Цена: {{ vueNumberFormat( product.price ) }}</p>
					</div>
					<div class="card-footer fs-5">
						<div v-if="!product.quantity" class="text-danger text-center">Нет в наличии</div>
						<div v-else class="d-flex justify-content-between align-items-center">
							<small class="text-body-secondary">Всего: {{ product.quantity }} шт.</small>
							<div class="add-to-cart d-flex justify-content-between align-items-center p-0">
								<input type="button" @click.prevent="this.$parent.addItem( product.id )" value="+" class="btn fs-5 p-0" />
								<input type="text" :value="product.added_items" class="form-control text-center fs-5 p-0" disabled />
								<input type="button" @click.prevent="this.$parent.removeItem( product.id )" value="-" class="btn fs-5 p-0" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex justify-content-end align-items-center">
			<div class="pe-4">Итого: <strong>{{ vueNumberFormat( this.$parent.total_price ) }}</strong></div>
			<a href="#" @click.prevent="goTo( 'cart' )" class="btn btn-lg btn-primary px-5">В корзину</a>
		</div>
	</div>
</template>

<script>
export default {
	name: "ProductsListComponent",

	data ()
	{
		return {

		}
	},

	methods:
	{
		goTo ( page )
		{
			this.$emit( 'goTo', page );
		}
	}
};
</script>

<style lang="scss" scoped>
@import '../../../../sass/import/fonts';
@import '../../../../sass/import/variables';
@import '../../../../sass/import/mixins';

@import 'bootstrap/scss/bootstrap';

.products_list {
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

		a {
			font-size: 30px;
		}
	}
}
</style>