<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use Livewire\Component;

class RecentEvents extends Component
{
    public $tableTitle;
    public $tableLink;
    public function render()
    {
        $data = [];
        if(request()->user()->role == 3){
            $data = NonLifeInsurance::whereIn('status', [1, 2, 3])
            ->where('user_id',request()->user()->id)
            ->with('user.customer')
            ->get();
        }
      
        // dd($data);
        return view('livewire.recent-events',['data'=> $data]);
    }
}
