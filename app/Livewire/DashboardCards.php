<?php

namespace App\Livewire;

use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardCards extends Component
{

    public $policyHolder;
    public $remainingPolicies;
    public $expiringPolicies;
    public $income;
    public function render()
    {

        $this->policyHolder = Transaction::whereIn('status',[1,3])->count()??0;
        $this->remainingPolicies = Policy::all()->sum('quantity')??0;
        $this->expiringPolicies = Transaction::where('status',3)->count()??0;
        $this->income = DB::table('transactions as tr')
                ->select(
                    DB::raw('SUM(nI.paid) as total_paid'),
                )
                ->join('non_life_insurances as nI', 'nI.id', '=', 'tr.non_life_id')
                ->pluck('total_paid');

                

        return view('livewire.dashboard-cards');
    }
}
