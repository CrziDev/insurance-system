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
        Schema::table('non_life_insurances', function (Blueprint $table) {
            $table->string('confirmation_cover_no')->nullable();
            $table->string('official_receipt_no')->nullable();
            $table->string('limit_premium_paid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('non_life_insurances', function (Blueprint $table) {
            $table->dropColumn('confirmation_cover_no');
            $table->dropColumn('official_receipt_no');
            $table->dropColumn('limit_premium_paid');
        });
    }
};
