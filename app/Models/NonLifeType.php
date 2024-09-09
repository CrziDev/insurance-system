<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonLifeType extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function nonLifeInsurance(){
        return $this->hasMany(NonLifeInsurance::class,'type_id');
    }
}
