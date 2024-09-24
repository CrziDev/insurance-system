<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use Livewire\Component;
class ShowPending extends Component
{

    public NonLifeInsurance $client;
    

    public function showForm(){
        $this->dispatch('close-modal',name:"pending-details");
        $this->dispatch('open-modal', name:'pending-form');
    }

    public function render()
    {
        return view('livewire.show-pending');
    }
}
