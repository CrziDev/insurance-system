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
        Schema::create('life_insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('non_life_types');

            $table->string('protection_package')->nullable();
            $table->string('allowance_package')->nullable();
            $table->string('present_business_address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email_address')->nullable();
            $table->string('name_of_beneficiary')->nullable();
            $table->string('name_of_trustee')->nullable();
            $table->string('tin')->nullable();
            $table->string('other_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('permanent_official_mail_address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('source_of_funds')->nullable();
       
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
        Schema::dropIfExists('life_insurances');
    }
};
