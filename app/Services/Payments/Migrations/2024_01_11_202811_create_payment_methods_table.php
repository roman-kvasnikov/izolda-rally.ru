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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->timestamps();

            $table->string('name'); // Способ оплаты
            $table->boolean('active')->default(false);

            $table->string('driver')->comment('Провайдер'); // stripe, paypal, tinkoff, yookassa
            $table->string('driver_currency_id')->nullable()->comment('Валюта провайдера');
            $table->foreign('driver_currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
