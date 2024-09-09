<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('non_life_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('non_life_types');
            $table->string('model')->nullable();
            $table->string('body_type')->nullable();
            $table->string('plate')->nullable();
            $table->string('serial_chassis')->nullable();
            $table->string('motor_num')->nullable();
            $table->string('color')->nullable();
            $table->string('blt_num')->nullable();
            $table->string('weight_capacity')->nullable();
            $table->string('authorize_capacity')->nullable();
            $table->string('make')->nullable();
            $table->string('paid')->nullable();
            $table->string('endorsement')->nullable();
            $table->string('limit_liabilty')->nullable();
            $table->string('premium_paid')->nullable();
            $table->date('date_effective')->nullable();
            $table->date('expiration')->nullable();
            $table->integer('status')->default(4);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('non_life_insurances');
    }
};
