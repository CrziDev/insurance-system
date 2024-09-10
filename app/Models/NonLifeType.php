<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function nonLifeInsurance(){
        return $this->hasMany(NonLifeInsurance::class,'type_id');
    }
    public function LifeInsurance(){
        return $this->hasMany(LifeInsurance::class,'type_id');
    }
}
