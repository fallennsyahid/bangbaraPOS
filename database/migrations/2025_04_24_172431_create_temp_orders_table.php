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
        Schema::create('temp_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // dari Midtrans
            $table->string('session_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('request')->nullable();
            $table->json('products');
            $table->integer('total_price');
            $table->string('serve_option');
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_orders');
    }
};
