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
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('processed_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('processed_at');
    });
}
};
