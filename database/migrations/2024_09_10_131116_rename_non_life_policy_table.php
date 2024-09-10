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
        Schema::rename('non_life_types','policies');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('policies','non_life_type');
        
    }
};
