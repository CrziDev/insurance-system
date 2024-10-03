<?php

namespace App\Livewire;

use App\Events\InsuranceCreated;
use App\Livewire\Forms\NonLifeInsuranceCustomerAttribute;
use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class AddNonLifeInsuranceForm extends Component
{ 
    public NonLifeInsuranceCustomerAttribute $form;
    public $buttonText = '';
    public $formAction = '';
    public $policyLists = [];
    public $premiumPaid= '';
    public $docstamp = '';
    public $localGovTax = '';
    public $others = '';
    public $total = '';
    public $selectedCustomer;
    public $userId;
    public $modal;

    public function save(){
        $this->validate();  


    
        $record = NonLifeInsurance::create([
            'user_id' => $this->userId,
            'model' => $this->form->model,
            'make' => $this->form->make,
            'plate' => $this->form->plateNo,
            'serial_chassis' => $this->form->serialChassis,
            'body_type' => $this->form->typeBody,
            'color' => $this->form->color,
            'authorize_capacity'  => $this->form->authorizedCapacity,
            'blt_num'  => $this->form->bltFileNo,
            'weight_capacity' => $this->form->weightCapacity,
            'limit_premium_paid' => $this->form->premiumPaidOnlimit,
            'limit_liabilty' => $this->form->limitLiabity,      
            'forms_and_indorsement' => $this->form->form_endorsement,
        ]);



        $user = User::find($this->userId);
        $transaction = Transaction::create([
            'non_life_id' => $record->id,
            'policy_type_id' => $this->form->policyId,
            'user_id' => $this->userId,
        ]);

        $policy = $transaction->policy; 

        $policy->update([
            'quantity' => (intval($policy->quantity)-1)
        ]);

        
        toastr()->success('Request was successfully submitted!');
        
        if(request()->user()->role == 3){
            $this->redirect('/customer/dashboard');
        }else{
            $this->redirect('/admin/request');
        }
        InsuranceCreated::dispatch($transaction,$user);
    }

    public function mount()
    {
        $user = User::with('customer')->find($this->userId);
        $this->form->firstName = $user->customer[0]->first_name;
        $this->form->lastName = $user->customer[0]->last_name;
        $this->form->businessProfession = $user->customer[0]->profession;
        $this->form->address = $user->customer[0]->address;
     
        $this->userId = $user->id;
        
        $this->policyLists = Policy::where('type','Non-life-type')->get();
    }


    public function selectOptions($id)
    {       
        $type= Policy::find($id);
        if(!$type){
            $this->resetExcept(['policyLists','form']);
            return false;
        }

        $this->populatepolicyFields($type,$id);

    }

    public function populatepolicyFields($type,$id){
        $this->form->policyId = $id;
        $this->premiumPaid= $type->premium;
        $this->docstamp = $type->docstamp;
        $this->localGovTax = $type->govtax;
        $this->others = $type->others;
        $this->total = (int)$type->premium + (int)$type->docsStamp + (int)$type->govtax + (int)$type->others;
    }

    public function render()
    {
        return view('livewire.add-non-life-insurance-form');
    }
}
