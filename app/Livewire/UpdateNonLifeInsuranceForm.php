<?php

namespace App\Livewire;

use App\Livewire\Forms\NonLifeInsuranceAdminAttribute;
use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class UpdateNonLifeInsuranceForm extends Component
{

    public NonLifeInsuranceAdminAttribute $form;
    public $buttonText = '';
    public $formAction = '';
    public $policyLists = [];
    public $premiumPaid= '';
    public $docstamp = '';
    public $localGovTax = '';
    public $others = '';
    public $total = '';
    public Transaction $selectedRow;
    public $modal;

    public function mount($policyId = null)
    {
     
        $user = User::with('customer')->find($this->selectedRow->user->id);
        $nonLifeType = Transaction::with('nonLifeInsurance')->find($this->selectedRow->id);
        $this->form->firstName = $user->customer[0]->first_name;
        $this->form->lastName = $user->customer[0]->last_name;
        $this->form->businessProfession = $user->customer[0]->profession;
        $this->form->address = $user->customer[0]->address;
        $this->form->model = $nonLifeType->nonLifeInsurance->model;
        $this->form->plateNo = $nonLifeType->nonLifeInsurance->plate; 
        $this->form->make = $nonLifeType->nonLifeInsurance->make; 
        $this->form->serialChassis = $nonLifeType->nonLifeInsurance->serial_chassis; 
        $this->form->typeBody = $nonLifeType->nonLifeInsurance->body_type; 
        $this->form->color = $nonLifeType->nonLifeInsurance->color; 
        $this->form->authorizedCapacity = $nonLifeType->nonLifeInsurance->make; 
        $this->form->bltFileNo = $nonLifeType->nonLifeInsurance->authorize_capacity; 
        $this->form->weightCapacity = $nonLifeType->nonLifeInsurance->weight_capacity; 
        $this->form->dateEffective = $nonLifeType->date_effective; 
        $this->form->expiration = $nonLifeType->expiration; 
        $this->form->confirmation_no = $nonLifeType->nonLifeInsurance->confirmation_cover_no; 
        $this->form->official_receipt = $nonLifeType->nonLifeInsurance->official_receipt_no; 
        $this->form->limitLiabity = $nonLifeType->nonLifeInsurance->limit_liabilty; 
        $this->form->premiumPaidOnlimit = $nonLifeType->nonLifeInsurance->limit_premium_paid; 
        $this->form->form_endorsement = $nonLifeType->nonLifeInsurance->forms_and_indorsement; 


        //Continue other field

        $this->selectOptions($this->selectedRow->policy_type_id);
        $this->policyLists = Policy::all();
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

    public function update(){
        $this->validate();
  
        Transaction::findOrFail($this->selectedRow->id)->update([
            "date_effective"=>$this->form->dateEffective,
            "expiration"=>$this->form->expiration,
            "status"=>1,
        ]);

        NonLifeInsurance::findOrFail($this->selectedRow->non_life_id)->update([
            "model"=> $this->form->model,
            "body_type"=> $this->form->typeBody,
            "plate"=> $this->form->plateNo,
            "serial_chassis"=> $this->form->serialChassis,
            // "motor_num"=> $this->form->policyId,
            "color"=> $this->form->color,
            "blt_num"=> $this->form->bltFileNo,
            "weight_capacity"=>$this->form->weightCapacity,
            "authorize_capacity"=>$this->form->authorizedCapacity,
            "make"=>$this->form->make,
            "limit_liabilty"=>$this->form->limitLiabity,
            "premium_paid"=>$this->form->premiumPaidOnlimit,
        ]);

        toastr()->success('Request Approved Successfuly!');
        $this->redirect('/admin/request');
    }
    
    public function render()
    {
        return view('livewire.update-non-life-insurance-form');
    }
}
