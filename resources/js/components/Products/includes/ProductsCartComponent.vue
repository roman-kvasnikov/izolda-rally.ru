<template>
	<div class="products_cart container px-0 my-5 clearfix">
		<div class="card">
			<div class="card-header p-3">
				<h2 class="fw-bold mx-3 my-0">Корзина</h2>
			</div>
			<div class="card-body">
				<div v-if="!this.$parent.added_to_cart" class="text-center p-4">
					Вы не добавили ни одного продукта
				</div>
				<div v-else>
					<div class="table-responsive">
						<table class="table table-bordered m-0">
							<thead>
								<tr>
									<th class="text-center py-2 px-2" style="min-width: 190px">Продукт</th>
									<th class="text-center py-2 px-2" style="width: 130px">Цена</th>
									<th class="text-center py-2 px-2" style="width: 100px">Количество</th>
									<th class="text-center py-2 px-2" style="width: 130px">Итог</th>
									<th class="text-center py-2 px-0" style="width: 40px"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="product in this.$parent.addedProducts" :key="product.id">
									<td class="p-3 align-middle">
										<div class="d-flex justify-content-start align-items-center">
											<img v-if="product.image" :src="'/images/products/' + product.image" class="card-img ui-w-150" :alt="product.name" />
											<div class="px-3">
												<h4>{{ product.name }}</h4>
												<p>{{ product.description }}</p>
											</div>
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ vueNumberFormat( product.price ) }}</td>
									<td class="text-center font-weight-semibold align-middle p-2">
										<div class="add-to-cart d-flex justify-content-between align-items-center">
											<input type="button" @click.prevent="this.$parent.addItem( product.id )" value="+" class="btn p-0" />
											<input type="text" :value="product.added_items" class="form-control text-center p-0" disabled />
											<input type="button" @click.prevent="this.$parent.removeItem( product.id )" value="-" class="btn p-0" />
										</div>
									</td>
									<td class="text-center font-weight-semibold align-middle p-2">{{ vueNumberFormat( product.price * product.added_items ) }}</td>
									<td class="text-center font-weight-semibold align-middle px-1">
										<a href="#" @click.prevent="this.$parent.removeProduct( product.id )" class="remove_item_link" title="Удалить"><i class="fas fa-window-close"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="d-flex flex-wrap justify-content-end align-items-center m-4">
						<div class="text-center">
							<div class="text-large">Итого: <strong>{{ vueNumberFormat( this.$parent.total_price ) }}</strong></div>
						</div>
					</div>
				</div>

				<div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
					<button @click.prevent="goTo( 'list' )" type="button" class="btn btn-lg btn-default"><i class="fa-solid fa-arrow-left px-2"></i> Назад к выбору</button>
					<button v-if="this.$parent.added_to_cart" type="button" class="btn btn-lg btn-primary px-5">Купить</button>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "ProductsCartComponent",

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

.products_cart {
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
			width: 30px;
		}
	}
}
</style>