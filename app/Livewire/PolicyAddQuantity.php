<?php

namespace App\Livewire;

use App\Models\NonLifeType;
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
        $quantity = NonLifeType::find($policy)->quantity;
        $this->quantity = $quantity;
        $this->policyId = $policy;
    }       

    public function save(){
        $this->validate();

        NonLifeType::find($this->policyId)->update([
            'quantity' => $this->quantity
        ]);

        toastr()->success('Updated Successfully!');
        return redirect('/admin/policies');
    }

    public function render()
    {

        $policies = NonLifeType::all();
        return view('livewire.policy-add-quantity',['policies'=>$policies]);
    }
}
