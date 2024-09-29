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
            $table->string('forms_and_indorsement')->nullable();
            $table->string('form_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('non_life_insurances', function (Blueprint $table) {
            $table->dropColumn('forms_and_indorsement');
            $table->dropColumn('form_id');
        });
    }
};
