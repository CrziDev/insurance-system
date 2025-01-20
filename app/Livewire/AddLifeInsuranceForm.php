<?php

namespace App\Livewire;

use App\Events\InsuranceCreated;
use App\Livewire\Forms\LifeInsuranceCustomerAttribute;
use App\Models\LifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class AddLifeInsuranceForm extends Component
{
    public LifeInsuranceCustomerAttribute $form;
    public $userId;
    public $modal;

    public function mount()
    {
        $user = User::with('customer')->find($this->userId);
        $this->userId =  $user->id;
        $this->form->full_name = $user->customer[0]->full_name;
        $this->form->mobile_number = $user->customer[0]->phone_number;
        $this->form->email_address = $user->email;
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
        
        $record = LifeInsurance::create( $data );

        $policy= Policy::where('type','Life policy')->first();

        $user = User::find($this->userId);
        $transaction = Transaction::create([
            'life_id' => $record->id,
            'policy_type_id' => $policy->id,
            'user_id' => $this->userId,
        ]);


        $policy = $transaction->policy; 
        $policy->update([
            'quantity' => (intval($policy->quantity)-1)
        ]);


        toastr()->success('Request was successfully submitted!');

        if(request()->user()->role == 3){
            $this->redirect('/customer/dashboard');
        }elseif(request()->user()->role == 2){
            $this->redirect('/staff/request');
        }else{
            $this->redirect('/admin/request');
        }
        
        InsuranceCreated::dispatch($transaction,$user);
    }


    public function render()
    {
        return view('livewire.add-life-insurance-form');
    }
}
