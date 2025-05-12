<?php

namespace App\Livewire;

use App\Livewire\Forms\NonLifeInsuranceAdminAttribute;
use App\Livewire\Forms\NonLifeInsuranceCustomerAttribute;
use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class PreviewNonLifeForm extends Component
{

    public NonLifeInsuranceCustomerAttribute $form;
    public $buttonText = '';
    public $formAction = '';
    public $policyLists = [];
    public $premiumPaid= '';
    public $premium= '';
    public $limitLiability= '';
    public $docstamp = '';
    public $localGovTax = '';
    public $others = '';
    public $total = '';
    public Transaction $selectedRow;
    public $modal;
    public $status;
    public $oldExpiration;

    public function mount()
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
        $this->form->authorizedCapacity = $nonLifeType->nonLifeInsurance->authorize_capacity; 
        $this->form->bltFileNo = $nonLifeType->nonLifeInsurance->blt_num; 
        $this->form->weightCapacity = $nonLifeType->nonLifeInsurance->weight_capacity; 
        $this->form->motoNum = $nonLifeType->nonLifeInsurance->motor_num;
       
        $this->form->premiumPaidOnlimit = $nonLifeType->nonLifeInsurance->limit_premium_paid; 
        $this->status = $nonLifeType->status;

        //Continue other field
        $this->selectOptions($this->selectedRow->policy_type_id);
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

        $this->limitLiability= $type->limit_liability;
        $this->premiumPaid = $type->premium_paid;


        $this->form->policyId = $id;
        $this->premium= $type->premium;
        $this->docstamp = $type->docstamp;
        $this->localGovTax = $type->govtax;
        $this->others = $type->others;
        $this->total = number_format((float)$type->premium + (float)$type->docsStamp + (float)$type->govtax + (float)$type->others + (float)$type->premium_paid,2);

    }

    public function update(){
        $this->validate();
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
            "limit_liabilty"=>$this->limitLiability,
            "premium_paid"=>$this->premiumPaid,
            "paid"=>$this->total,
            "motor_num"=>$this->form->motoNum,
        ]);

        toastr()->success('Insurance Updated Successfully!');
        $this->dispatch('close-modal', name:'pending-form');

    }

    public function render()
    {
        return view('livewire.preview-non-life-form');
    }
}
