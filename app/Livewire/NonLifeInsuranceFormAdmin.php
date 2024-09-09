<?php

namespace App\Livewire;
use App\Livewire\Forms\NonLifeInsuranceAdminAttribute;
use App\Models\NonLifeInsurance;
use App\Models\NonLifeType;

use Livewire\Component;

class NonLifeInsuranceFormAdmin extends Component
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
    public $selectedCustomer;

    public function mount($policyId = null)
    {
        $this->selectOptions($policyId);
        $this->policyLists = NonLifeType::all();
    }


    public function selectOptions($id)
    {        

        $type= NonLifeType::find($id);
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
    
    public function approveForm($id){
        $validated = $this->validate();

        NonLifeInsurance::findOrFail($id)->update([
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
            "date_effective"=>$this->form->dateEffective,
            "expiration"=>$this->form->expiration,
            "status"=>1,
        ]);

        toastr()->success('Request Approved Successfuly!');
        $this->redirect('/admin/transactions');
    }

    public function save(){
        $this->validate();  

        NonLifeInsurance::create([
            'user_id' => request()->user()->id,
            'type_id' => $this->form->policyId,
            'model' => $this->form->model,
            'make' => $this->form->make,
            'plate' => $this->form->plateNo,
            'serial_chassis' => $this->form->serialChassis,
            'body_type' => $this->form->typeBody,
            'color' => $this->form->color,
            'authorize_capacity'  => $this->form->authorizedCapacity,
            'blt_num'  => $this->form->bltFileNo,
            'weight_capacity' => $this->form->weightCapacity,
        ]);

        toastr()->success('Request was successfully submitted!');
        $this->redirect('/customer/dashboard');
    }

    public function render()
    {
        return view('livewire.non-life-insurance-form-admin');
    }
}
