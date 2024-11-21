<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Policy;
use App\Models\User;
use App\Models\Transaction;


class NonLifeInsurance extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Policy(){
        return $this->belongsTo(Policy::class,"type_id");
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'id',"non_life_id");
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
