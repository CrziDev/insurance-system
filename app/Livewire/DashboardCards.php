<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\Policy;
use Livewire\Component;

class DashboardCards extends Component
{

    public $policyHolder;
    public $remainingPolicies;
    public $expiringPolicies;

    public function render()
    {

        $this->policyHolder = NonLifeInsurance::where('status',1)->count()??0;
        $this->remainingPolicies = Policy::all()->sum('quantity')??0;
        $this->expiringPolicies = NonLifeInsurance::where('status',3)->count()??0;

        return view('livewire.dashboard-cards');
    }
}
