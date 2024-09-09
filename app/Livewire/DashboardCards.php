<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\NonLifeType;
use Livewire\Component;

class DashboardCards extends Component
{

    public $policyHolder;
    public $remainingPolicies;
    public $expiringPolicies;

    public function render()
    {

        $this->policyHolder = NonLifeInsurance::where('status',1)->count()??0;
        $this->remainingPolicies = NonLifeType::all()->sum('quantity')??0;
        $this->expiringPolicies = NonLifeInsurance::where('status',3)->count()??0;

        return view('livewire.dashboard-cards');
    }
}
