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
            $table->decimal('premium')->nullable();
            $table->decimal('docstamp')->nullable();
            $table->decimal('govtax')->nullable();
            $table->decimal('others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn('premium');
            $table->dropColumn('docstamp');
            $table->dropColumn('govtax');
            $table->dropColumn('others');
        });
    }
};
