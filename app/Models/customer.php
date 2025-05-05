<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;


class customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullNameAttribute(){
        return $this->first_name ." ".$this->middle_initial. ". ". $this->last_name ." ".$this->name_extention. ".";
    }

 
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
