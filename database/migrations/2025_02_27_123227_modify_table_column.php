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
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn('premium');
            $table->dropColumn('docstamp');
            $table->dropColumn('govtax');
            $table->dropColumn('others');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->string('premium')->nullable();
            $table->string('docstamp')->nullable();
            $table->string('govtax')->nullable();
            $table->string('others')->nullable();
        });
    }
};
