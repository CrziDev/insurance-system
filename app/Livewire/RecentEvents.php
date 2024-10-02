<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;

class RecentEvents extends Component
{
    public $tableTitle;
    public $tableLink;
    public function render()
    {
        
        if (request()->user()->role == 3) {
            $data = Transaction::whereIn('status', [1, 2, 3, 4, 5, 6])
                ->where('user_id', request()->user()->id)
                ->with('user.customer')
                ->orderBy('updated_at', 'desc') // Sort by created_at or any relevant column
                ->get();
        } else {
            $data = Transaction::whereIn('status', [1, 2, 3, 4, 5, 6])
                ->with('user.customer')
                ->orderBy('updated_at', 'desc') // Sort by created_at or any relevant column
                ->get();
        }
      
        // dd($data);
        return view('livewire.recent-events',['data'=> $data]);
    }
}
