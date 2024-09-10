<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyAddQuantity extends Component
{

    public $policy;
    public $quantity;
    public $policyId;

    // Validation rules
    protected $rules = [
        'policy' => 'required',
        'quantity' => 'required|numeric|min:1',
    ];
    public function selectedPolicy($policy){
        $quantity = Policy::find($policy)->quantity;
        $this->quantity = $quantity;
        $this->policyId = $policy;
    }       

    public function save(){
        $this->validate();

        Policy::find($this->policyId)->update([
            'quantity' => $this->quantity
        ]);

        toastr()->success('Updated Successfully!');
        return redirect('/admin/policies');
    }

    public function render()
    {

        $policies = Policy::all();
        return view('livewire.policy-add-quantity',['policies'=>$policies]);
    }
}
