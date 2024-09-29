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

    public Transaction $transactions;
    public $selected;
    public $duration;
    public $clientId;
    public $policyId;
    public $modal;
   


    public function selectedRow(Transaction $selectedRow)
    {
        $this->transactions = $selectedRow;
        $this->policyId = $selectedRow->type_id;
        $this->dispatch('open-modal-child', name: 'view-insurance');
    }

    public function mount(){
        $this->transactions = $this->selected;
    }
    
    public function render()
    {
        return view('livewire.show-other-status');
    }
}
