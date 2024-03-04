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
		Schema::create('payments', function (Blueprint $table) {
			$table->id()->from(1001);
			$table->uuid('uuid')->unique();
			$table->timestamps();
			// $table->timestamp('expires_at'); // Например когда платеж истекает

			$table->string('status');
			// $table->timestamp('status_at'); // Дата когда менялся статус
			// $table->string('status_comment')->nullable(); // Админ может отменить платеж и написать причину отмены

			$table->string('currency_id');
			$table->foreign('currency_id')->references('id')->on('currencies');
			$table->decimal('amount', 12, 2);

			$table->string('payable_type'); // order, subscription, service
			$table->integer('payable_id');

			// $table->morph('payable'); // The same like two previous commands

			$table->foreignId('method_id')->nullable();
			$table->foreign('method_id')->references('id')->on('payment_methods');

			// $table->foreignId('method_id')->nullable()->constrained('payment_methods'); // The same like two previous commands

			$table->string('driver')->nullable();
			$table->string('driver_currency_id')->nullable()->comment('Валюта провайдера');
			$table->foreign('driver_currency_id')->references('id')->on('currencies');
			$table->decimal('driver_amount', 12, 2)->nullable();
			$table->string('driver_payment_id')->nullable()->comment("Provider's payment ID");
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('payments');
	}
};
