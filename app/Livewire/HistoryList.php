<?php

namespace App\Livewire;

use App\Models\RenewedHistory;
use Livewire\Component;

class HistoryList extends Component
{
    public $tableTitle;
    public function render()
    {

        $renewedHistory = RenewedHistory::whereHas('transaction',function($q){
            $q->where('user_id', '=', request()->user()->id);
        })->with('transaction')->get();
        
        return view('livewire.history-list',['data'=>$renewedHistory]);
    }
}
