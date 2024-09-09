<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('non_life_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('premium');
            $table->string('docstamp');
            $table->string('govtax');
            $table->string('others');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_life_types');
    }
};
