<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyAdd extends Component
{
    public $name;
    public $premium;
    public $docstamp;
    public $govTax;
    public $others;
    public $quantity;
    public $policyType;
    public $selectedType;
    public $premiumPaid;
    public $limitLiability;


    // Validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'premium' => 'required|numeric|min:3',
        'docstamp' => 'required|numeric|min:3',
        'govTax' => 'required|numeric|min:3',
        'others' => 'required|numeric|min:3',
        'quantity' => 'required|numeric|min:3',
        'policyType' => 'required',
        'premiumPaid' => 'required',
        'limitLiability' => 'required',
    ];

    public function save()
    {
        // Validate based on selected policy type
        if ($this->selectedType === "Non-life-type") {
            $this->validate(); // Validate all fields

            Policy::create([
                'name' => $this->name,
                'premium' => $this->premium,
                'docstamp' => $this->docstamp,
                'govTax' => $this->govTax,
                'others' => $this->others,
                'quantity' => $this->quantity,
                'type' => $this->policyType,
                'limit_liability' => $this->premiumPaid,
                'premium_paid' => $this->limitLiability,
            ]);
        } else {
            // Custom validation for the else case
            $this->validate([
                'name' => 'required|min:3',
                'policyType' => 'required',
                'quantity' => 'required|numeric',
            ]);

            Policy::create([
                'name' => $this->name,
                'premium' => 0, // Or default values if necessary
                'docstamp' => 0,
                'govTax' => 0,
                'others' => 0,
                'quantity' => $this->quantity,
                'type' => $this->policyType,
            ]);
        }

        // Success message and redirect
        toastr()->success('Policy Added Successfully!');
        return redirect('/admin/policies');
    }

    public function selectPolicyType($type)
    {
        $this->selectedType = $type;
    }

    public function render()
    {
        return view('livewire.policy-add');
    }
}
