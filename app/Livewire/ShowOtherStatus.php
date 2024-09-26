<?php

namespace App\Livewire;

use App\Models\LifeInsurance;
use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

use function PHPUnit\Framework\isNull;

class ShowOtherStatus extends Component
{

    public $client;
    public $duration;

    
    public function render()
    {
        $transactions = [];

        
        if(!is_Null($this->client->non_life_id) ){
            $transactions = Transaction::find($this->client->id)->with('policy', 'nonLifeInsurance','user.customer')->first();
        }

        if(!is_Null($this->client->life_id) ){
            $transactions = Transaction::find($this->client->id)->with('policy', 'lifeInsurance','user.customer')->first();
        }

        $effectiveDate = Carbon::parse($transactions->date_effective);
        $expiringDate = Carbon::parse($transactions->expiration);
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
        
        $this->duration = $result ?: '0 days'; 

        return view('livewire.show-other-status',['data'=>$transactions]);
    }
}
