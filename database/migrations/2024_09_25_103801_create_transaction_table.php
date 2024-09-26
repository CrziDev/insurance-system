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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_life_id')->constrained('non_life_insurances');
            $table->foreignId('life_id')->constrained('life_insurances');
            $table->foreignId('policy_type_id')->constrained('policies');
            $table->date('date_effective')->nullable();
            $table->date('expiration')->nullable();
            $table->integer('status')->default(4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
