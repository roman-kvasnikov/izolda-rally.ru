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
        Schema::create('carts', function (Blueprint $table) {
            $table->id()->from(1001);
            $table->string('session_id');

            $table->unsignedBigInteger('merch_id');
            $table->index('merch_id', 'cart_merch_idx');
            $table->foreign('merch_id', 'cart_merch_fk')->references('id')->on('merches');

            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
