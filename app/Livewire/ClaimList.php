<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class ClaimList extends Component
{
    public $tableTitle;
    public $transaction;
    public $status = ''; 

    public function selectClaim(Transaction $claim)
    {      
        $this->transaction = $claim;
        if($claim->status == 1){
            $this->dispatch('open-modal', name: 'claim-add');
        }

        if($claim->status == 5 || $claim->status == 6){

            $this->dispatch('open-modal', name: 'claim-check-file');
        }
    }

    public function filterStatus($status)
    {
        $this->status = $status;
    }

    public function render()
    {

        $user = request()->user();
        
        
        $claims = Transaction::with('policy', 'nonLifeInsurance','lifeInsurance','user')
        ->orderByDesc('created_at');

        if ($user->role == 3) {
            $claims->whereIn('status',[1,3,5,6])->where('user_id', $user->id);

            if ($this->status) {
                $claims->where('status', $this->status);
            }
        }else{
            $claims->whereIn('status',[5,6]);
        }

        

        return view('livewire.claim-list',['data' => $claims->get()]);
    }
}
