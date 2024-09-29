<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use Livewire\Component;

class DashboardCards extends Component
{

    public $policyHolder;
    public $remainingPolicies;
    public $expiringPolicies;

    public function render()
    {

        $this->policyHolder = Transaction::whereIn('status',[1,3])->count()??0;
        $this->remainingPolicies = Policy::all()->sum('quantity')??0;
        $this->expiringPolicies = Transaction::where('status',3)->count()??0;

        return view('livewire.dashboard-cards');
    }
}
