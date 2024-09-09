<?php

namespace App\Livewire;

use App\Livewire\Forms\NonLifeInsuranceAdminAttribute;
use App\Models\NonLifeInsurance;
use App\Models\NonLifeType;
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
    public $selectedRow;

    public function mount($policyId = null)
    {

        $user = User::with('customer')->find($this->selectedRow->user->id);

        $this->form->firstName = $user->customer[0]->first_name;
        $this->form->lastName = $user->customer[0]->last_name;
        $this->form->businessProfession = $user->customer[0]->profession;
        $this->form->address = $user->customer[0]->address;


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

    public function update(){
        $this->validate();

        NonLifeInsurance::findOrFail($this->selectedRow->id)->update([
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
    
    public function render()
    {
        return view('livewire.update-non-life-insurance-form');
    }
}
