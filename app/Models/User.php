<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\customer;
use App\Models\NonLifeInsurance;
use App\Models\LifeInsurance;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getGreetingAttribute() {
        // $hour = now()->timezone('Asia/Manila')->format('h A');

        // if ($hour >= '08 PM') {
        //     $greetings = "Good Evening";
        // } elseif ($hour > '05 PM') {
        //     $greetings = "Good Evening";
        // } elseif ($hour > '11 AM') {
        //     $greetings = "Good Afternoon";
        // } else {
        //     $greetings = "Good Morning";
        // }
        return 'Good Day';
    }
    
    public function customer(){
        return $this->hasMany(customer::class,'user_id');
    }
    
    public function nonLifeInsurance(){
        return $this->hasMany(NonLifeInsurance::class,'user_id');
    }

    public function lifeInsurance(){
        return $this->hasMany(LifeInsurance::class,'user_id');
    }
}
