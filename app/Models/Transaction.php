<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Policy;
use App\Models\NonLifeInsurance;
use App\Models\LifeInsurance;
use App\Models\User;
use App\Models\TransactionAttachment;



class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function getCreatedAtFormatAttribute()
    {

        return $this->created_at ? $this->created_at->format('M d, Y') : null;
    }

    protected function getDateEffectFormatAttribute()
    {

        return !is_null($this->date_effective) ? 
        Carbon::createFromFormat('Y-m-d', $this->date_effective)->timezone(config('app.timezone'))->format('M d, Y') : 
        null;
       
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
        return !is_null($this->expiration) ? 
        Carbon::createFromFormat('Y-m-d', $this->expiration)->timezone(config('app.timezone'))->format('M d, Y') : 
        null;
       
    }

    protected function getUpdatedFormatAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)
            ->timezone(config('app.timezone'))  
            ->format('M d, Y');
       
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
