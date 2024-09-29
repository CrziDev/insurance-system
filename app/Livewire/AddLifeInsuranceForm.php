<?php

namespace App\Livewire;

use App\Livewire\Forms\LifeInsuranceCustomerAttribute;
use App\Models\LifeInsurance;
use App\Models\User;
use Livewire\Component;

class AddLifeInsuranceForm extends Component
{
    public LifeInsuranceCustomerAttribute $form;
    public $userId;
    public $modal;

    public function mount($policyId = null)
    {

        dd($this->modal);
        $user = User::with('customer')->find($this->userId);
        $this->userId =  $user->id;
    }



    public function selectPackage($value) {
        if (!in_array($value, $this->form->protection_package )) {
            $this->form->protection_package [] = $value;
        } else {
            $this->form->protection_package  = array_filter($this->form->protection_package , function($val) use ($value) {
                return $val !== $value;
            });
        }

        $this->form->protection_package  = array_values($this->form->protection_package );
    }


    public function allowancePackage($value) {
        if (!in_array($value, $this->form->protection_package )) {
            $this->form->allowance_package[] = $value;
        } else {
            $this->form->allowance_package = array_filter($this->form->allowance_package, function($val) use ($value) {
                return $val !== $value;
            });
        }

        $this->form->allowance_package = array_values($this->form->allowance_package);
    }

    public function save(){
       $data = $this->validate();
    
        $data['protection_package'] = json_encode($data['protection_package']);
        $data['allowance_package'] = json_encode($data['allowance_package']);
        $data['user_id'] = $this->userId;
        

        LifeInsurance::create( $data );
    }


    public function render()
    {
        return view('livewire.add-life-insurance-form');
    }
}
