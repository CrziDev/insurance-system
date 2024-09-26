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
            $table->dropConstrainedForeignId('type_id');
        });

        Schema::table('transactions', function (Blueprint $table) {
         
            $table->foreignId('life_id')->nullable()->change();
            $table->foreignId('policy_type_id')->nullable()->change();
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
