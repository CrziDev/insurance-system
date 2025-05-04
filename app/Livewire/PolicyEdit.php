<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyEdit extends Component
{

    public $policy;
    public $quantity = 0;
    public $policyId;
    public $policyType;
    public $selectedType;

    public $name = '';
    public $limitLiability = '';
    public $premiumPaid = '';
    public $premium = '';
    public $docstamp = '';
    public $others = '';
    public $govtax = '';

    // Validation rules
    protected $rules = [
        'policy' => 'required',
        'quantity' => 'required|numeric|min:1',
    ];
    public function selectedPolicy($policyId){
    
        $policy = Policy::find($policyId);

        $this->quantity = $policy->quantity;
        $this->selectedType = $policy->type;
        $this->policyId = $policy;
        $this->limitLiability = $policy->limit_liability;
        $this->premiumPaid = $policy->premium_paid;
        $this->docstamp = $policy->docstamp;
        $this->premium = $policy->premium;
        $this->govtax = $policy->govtax;
        $this->others = $policy->others;
        $this->name = $policy->name;

    }       

    public function save(){
        $this->validate();
    
        $policy = Policy::find($this->policyId);
        
        $policy->update([
            'quantity' => $this->quantity,
            'limit_liability' => $this->limitLiability,
            'premium_paid' => $this->premiumPaid,
            'docstamp' => $this->docstamp,
            'premium' => $this->premium,
            'govtax' => $this->govtax,
            'name' => $this->name,
            'others' => $this->others,
        ]);

        toastr()->success('Policy Has been Updated');
        $this->redirect('/admin/policies');
    }
    

    public function render()
    {

        $policies = Policy::all();
        return view('livewire.policy-edit',['policies'=>$policies]);
    }
}
