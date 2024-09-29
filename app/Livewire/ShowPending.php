<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;
class ShowPending extends Component
{

    public Transaction $client;
    

    public function mount(){
        $this->client = Transaction::with('nonLifeInsurance')->find($this->client->id);
    }
    public function showForm(){
        $this->dispatch('close-modal',name:"pending-details");
        $this->dispatch('open-modal', name:'pending-form');
    }

    public function render()
    {
        return view('livewire.show-pending');
    }
}
