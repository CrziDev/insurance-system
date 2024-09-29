<?php

namespace App\Livewire;

use App\Models\customer;
use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;

class ShowPolicyStatus extends Component
{
    public customer $selectedCustomer;
    public NonLifeInsurance $selectedRow;
    public $fullName;
    public $data = [];

    public function selectRow(NonLifeInsurance $selectedRow){
        $this->selectedRow = $selectedRow;  
        $this->dispatch('open-modal-child',name:'view-insurance');
    }
    
    public function addInsurance($type){
        if($type == 'non-life'){
            $this->dispatch('open-modal-child',name:'add-insurance');
        }   
    }

    public function boot(){
        $this->data = Transaction::with('Policy')
        ->where('user_id',$this->selectedCustomer->user->id)
        ->whereIn('status',[1,2,3])
        ->orderBydesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.show-policy-status');
    }
}
