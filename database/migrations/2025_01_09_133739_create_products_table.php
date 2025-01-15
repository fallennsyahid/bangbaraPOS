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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on("categories")->onDelete('cascade');
            $table->string('nama_menu');
            $table->integer('harga_menu');
            $table->text('deskripsi_menu');
            $table->text('gambar_menu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table){
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
        });
    }
};
