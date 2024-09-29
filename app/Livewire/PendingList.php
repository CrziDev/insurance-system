<?php

namespace App\Livewire;

use App\Models\LifeInsurance;
use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;

class PendingList extends Component
{
    public Transaction $selectedRow;
    public $tableTitle;
    public $search;
    public $status = ''; // Add this line
    protected $queryString = ['search', 'status'];

    public function selectRow(Transaction $selectedRow)
    {
        $this->selectedRow = $selectedRow;
        if($this->selectedRow->status == 4){
            $this->dispatch('open-modal', name: 'pending-details');
        };

        if($this->selectedRow->status == 1){
            $this->dispatch('open-modal', name: 'show-status-details');
        };

    }

    public function filterStatus($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        $user = request()->user();
        
        $transactions = Transaction::whereIn('status',[1,4])->with('policy', 'nonLifeInsurance','lifeInsurance','user')
        ->orderByDesc('status');
        

        if ($user->role == 3) {
            $transactions->where('user_id', $user->id);
        }
        
        // $query2 = LifeInsurance::with('user.customer')->orderByDesc('status');


        // // dd($query2);
            
        //     if ($user->role == 3) {
        //         $query->where('user_id', $user->id);

        //         $query2->where('user_id', $user->id);
        //     } else {
        //         $searchTerm = '%' . $this->search . '%';
                
        //         $query->where(function ($query) use ($searchTerm) {
        //             $query->whereHas('Policy', function ($q) use ($searchTerm) {
        //                 $q->where('name', 'like', $searchTerm);
        //             })
        //             ->orWhereHas('user.customer', function ($q) use ($searchTerm) {
        //                 $q->where('first_name', 'like', $searchTerm);
        //             });
        //         });

        //         $query2->where(function ($query2) use ($searchTerm) {
        //             $query2->WhereHas('user.customer', function ($q2) use ($searchTerm) {
        //                 $q2->where('first_name', 'like', $searchTerm);
        //             });
        //         });
        //     }
            
        //     // Apply status filter for NonLifeInsurance
        //     if ($this->status) {
        //         $query->where('status', $this->status);
        //         $query2->where('status', $this->status);
        //     }
            
        //     $nonLifeInsurance = $query->get();
        //     $lifeInsurance = $query2->get();

            // dd($lifeInsurance);

        // Combine both results
        // $combinedResults = $nonLifeInsurance->merge($lifeInsurance);|


        return view('livewire.pending-list', ['data' => $transactions->get(), 'user' => $user]);
    }
}
