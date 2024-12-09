<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class RenewedHistory extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date_expired' => 'datetime',
        'date_renewed' => 'datetime'
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    protected function getDateExpiredAtAttribute()
    {
        return $this->date_expired ? $this->date_expired->format('M d, Y') : null;
    }

    protected function getDateRenewedAtAttribute()
    {
        return $this->date_renewed ? $this->date_renewed->format('M d, Y') : null;
    }
}
