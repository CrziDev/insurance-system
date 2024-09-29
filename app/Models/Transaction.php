<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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

    protected function getDurationAttribute()
    {
        $effectiveDate = Carbon::parse($this->date_effective);
        $expiringDate = Carbon::parse($this->expiration);
        $diff = $effectiveDate->diff($expiringDate);
        
        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;
        
        $result = '';
        
        if ($years > 0) {
            $result .= $years . ' year' . ($years > 1 ? 's' : '') . ', ';
        }
        if ($months > 0) {
            $result .= $months . ' month' . ($months > 1 ? 's' : '') . ', ';
        }
        if ($days > 0) {
            $result .= $days . ' day' . ($days > 1 ? 's' : '');
        }
        
        // Trim any trailing commas and spaces
        $result = rtrim($result, ', ');
        
        return  $result ?: '0 days'; 
       
    }

    protected function getDateExpirationFormatAttribute()
    {
        return  Carbon::createFromFormat('Y-m-d',$this->expiration)->format('M d, Y');
       
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
            5 => "Insurance claim has been requested",
            6 => "Insurance claim Has been Approved",
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
            5 => "Requested",
            6 => "Claimed",
        ];
       return $statusText[$this->status];
    }

    public function policy(){
        return $this->belongsTo(Policy::class,"policy_type_id");
    }
   
    public function nonLifeInsurance(){
        return $this->belongsTo(NonLifeInsurance::class,'non_life_id');
    }
    public function lifeInsurance(){
        return $this->belongsTo(LifeInsurance::class,'life_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function attachment(){
        return $this->hasMany(TransactionAttachment::class,'transaction_id');
    }
}
