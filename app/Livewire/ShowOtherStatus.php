<?php

namespace App\Livewire;

use App\Models\LifeInsurance;
use App\Models\NonLifeInsurance;
use Livewire\Component;

class ShowOtherStatus extends Component
{

    public $client;
    
    public function render()
    {
        return view('livewire.show-other-status');
    }
}
