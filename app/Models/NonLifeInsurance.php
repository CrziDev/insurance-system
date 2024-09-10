<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonLifeInsurance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function getCreatedAtFormatAttribute()
    {
       return $this->created_at->format('M d, Y');
    }

    protected function getDateEffectFormatAttribute()
    {
        return  Carbon::createFromFormat('Y-m-d',$this->date_effective)->format('M d, Y');
       
    }

    protected function getDateExpirationFormatAttribute()
    {
        return  Carbon::createFromFormat('Y-m-d',$this->date_effective)->format('M d, Y');
       
    }

    protected function getUpdatedFormatAttribute()
    {
        return  Carbon::createFromFormat('Y-m-d H:m:s',$this->updated_at)->format('M d, Y');
       
    }

    protected function getStatusEventAttribute()
    {


        $statusMessage = [
            1 => "Request Has been approved",
            2 => "Expired Insurance",
            3 => "Expiring Insurance",
            4 => "Request Has been submitted",
        ];
        return  $statusMessage[$this->status];
       
    }

    
    protected function getStatusDescriptionAttribute()
    {
        $statusText = [
            1 => "Approved",
            2 => "Expired",
            3 => "Expiring",
            4 => "Pending",
        ];
       return $statusText[$this->status];
    }

    public function Policy(){
        return $this->belongsTo(Policy::class,"type_id");
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
