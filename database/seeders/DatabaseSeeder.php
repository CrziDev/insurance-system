<?php

namespace Database\Seeders;

use App\Http\Controllers\Customer\CustomerClaimsController;
use App\Models\customer;
use App\Models\Policy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(['role'=>1]);
        User::factory()->create(['role'=>2]);
        User::factory()->create(['role'=>3]);
        User::factory()->create(['role'=>3]);

        Customer::create([
            'user_id' => 3,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'profession' => fake()->jobTitle(),
            
        ]);

        Customer::create([
            'user_id' => 4,
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'profession' => fake()->jobTitle(),
            
        ]);

        Policy::create([

            'name'=> fake()->name(),
            'premium'=> fake()->numberBetween(0,100),
            'docstamp'=> fake()->numberBetween(0,100),
            'govtax'=> fake()->numberBetween(0,100),
            'others'=> fake()->numberBetween(0,100),

        ]);

        Policy::create([

            'name'=> fake()->name(),
            'premium'=> fake()->numberBetween(0,100),
            'docstamp'=> fake()->numberBetween(0,100),
            'govtax'=> fake()->numberBetween(0,100),
            'others'=> fake()->numberBetween(0,100),

        ]);


    }
}
