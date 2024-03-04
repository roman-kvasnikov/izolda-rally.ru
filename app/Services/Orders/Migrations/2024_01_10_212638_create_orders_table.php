<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id()->from(1001);
			$table->uuid('uuid')->unique();

			$table->string('status');

			$table->string('currency_id');
			$table->index('currency_id', 'order_currency_idx');
			$table->foreign('currency_id', 'order_currency_fk')->references('id')->on('currencies');

			$table->string('cart_session_id');
			// $table->index('cart_session_id', 'order_cart_idx');
			// $table->foreign('cart_session_id', 'order_cart_fk')->references('session_id')->on('carts');

			$table->decimal('amount', 12, 2);

			$table->string('last_name')->nullable();
			$table->string('first_name')->nullable();
			$table->string('middle_name')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('delivery_method')->nullable();
			$table->string('city')->nullable();
			$table->string('postal_code')->nullable();
			$table->string('region')->nullable();
			$table->string('address')->nullable();
			$table->string('cdek_address')->nullable();
			$table->text('note')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('orders');
	}
};
