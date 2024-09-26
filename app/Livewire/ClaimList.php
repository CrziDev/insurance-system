<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class ClaimList extends Component
{
    public $tableTitle;
    public $transaction;

    public function selectClaim(Transaction $claim)
    {      
        $this->transaction = $claim;
        $this->dispatch('open-modal', name: 'claim-add');
    }

    public function render()
    {

        $user = request()->user();
        
        
        $claims = Transaction::whereIn('status',[1,3,5])->with('policy', 'nonLifeInsurance','lifeInsurance','user')
        ->orderByDesc('status');

        if ($user->role == 3) {
            $claims->where('user_id', $user->id);
        }

        return view('livewire.claim-list',['data' => $claims->get()]);
    }
}
