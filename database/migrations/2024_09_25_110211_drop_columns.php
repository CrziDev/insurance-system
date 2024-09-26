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
            $table->dropColumn('date_effective');
            $table->dropColumn('expiration');
            $table->dropColumn('status');
        });

        
        Schema::table('life_insurances', function (Blueprint $table) {
            $table->dropColumn('date_effective');
            $table->dropColumn('expiration');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
