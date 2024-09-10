<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use Livewire\Component;

class RecentTransactions extends Component
{

    public $tableTitle;
    public $search;
    protected $queryString = ['search'];
    public function render()
    {

        $user = request()->user();

        if($user->role == 3){
            $nonLifeInsurance = NonLifeInsurance::with('Policy')
            ->with('user.customer')
            ->where('user_id',$user->id)
            ->where('status',4)
            ->orderBydesc('created_at')->get();
        }else{
            $searchTerm = '%'.$this->search.'%';

            $nonLifeInsurance = NonLifeInsurance::where(function($query) use ($searchTerm) {
                    $query->whereHas('Policy', function($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm);
                    })
                    ->orWhereHas('user.customer', function($q) use ($searchTerm) {
                        $q->where('first_name', 'like', $searchTerm);
                    });
                })
                ->orderByDesc('updated_at')
                ->with(['Policy', 'user.customer'])
                ->get();
            
        }
      
        return view('livewire.recent-transactions',['data'=>$nonLifeInsurance,'user'=> $user ]);
    }
}
