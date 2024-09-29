<?php

namespace App\Livewire;

use App\Livewire\Forms\LifeInsuranceAdminAttribute;
use App\Models\LifeInsurance;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateLifeInsuranceForm extends Component
{
    public LifeInsuranceAdminAttribute $form;
    public Transaction $selectedRow;
    public $userId;
    public $modal;
    #[Validate('required')]
    public $dateEffective;
    #[Validate('required')]
    public $expiration;


    public function mount()
    {
        $user = User::with('customer')->find($this->selectedRow->user->id);
        $lifeType = Transaction::with('lifeInsurance')->find($this->selectedRow->id);
        $this->form->full_name = $user->customer[0]->full_name;
        $this->form->mobile_number = $user->customer[0]->phone_number;
        $this->form->email_address = $user->email;

        $lifeInsuranceData = $lifeType->lifeInsurance->toArray();

        foreach ($lifeInsuranceData as $key => $value) {

            if (property_exists($this->form, $key)) {
                if($key == "protection_package"||$key == "allowance_package"){
              
                   $value =  json_decode($value);
                
                }
                $this->form->{$key} = $value;
            }
            
        }
    }


    public function selectPackage($value) {
        if (!in_array($value,$this->form->protection_package )) {
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
    public function update(){
        $data = $this->validate();
       
        unset($data['dateEffective'], $data['expiration']);
  
        Transaction::findOrFail($this->selectedRow->id)->update([
            "date_effective"=>$this->dateEffective,
            "expiration"=>$this->expiration,
            "status"=>1,
        ]);

        LifeInsurance::findOrFail($this->selectedRow->life_id)->update($data);

        toastr()->success('Request Approved Successfuly!');
        $this->redirect('/admin/request');
    }

    public function render()
    {
        return view('livewire.update-life-insurance-form');
    }
}
