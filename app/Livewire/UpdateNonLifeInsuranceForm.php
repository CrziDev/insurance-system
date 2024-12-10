<?php

namespace App\Livewire;

use App\Action\PrintForm;
use App\Events\InsuranceApproved;
use App\Livewire\Forms\NonLifeInsuranceAdminAttribute;
use App\Models\NonLifeInsurance;
use App\Models\Policy;
use App\Models\RenewedHistory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Twilio\Rest\Client;

class UpdateNonLifeInsuranceForm extends Component
{

    public NonLifeInsuranceAdminAttribute $form;
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
       
        if (!isset($nonLifeType->date_effective)) {
            $this->form->dateEffective = date('Y-m-d'); // Current date
        } else {
            $this->form->dateEffective = $nonLifeType->date_effective;
        }
        
        if (!isset($nonLifeType->expiration)) {
            // Set expiration to 1 year from now
            $this->form->expiration = date('Y-m-d', strtotime('+1 year'));
        } else {
            $this->form->expiration = $nonLifeType->expiration;
        }


        $this->form->confirmation_no = $nonLifeType->nonLifeInsurance->confirmation_cover_no; 
        $this->form->official_receipt = $nonLifeType->nonLifeInsurance->official_receipt_no; 
        $this->form->limitLiabity = $nonLifeType->nonLifeInsurance->limit_liabilty; 
        $this->form->premiumPaidOnlimit = $nonLifeType->nonLifeInsurance->limit_premium_paid; 
        $this->form->form_endorsement = $nonLifeType->nonLifeInsurance->forms_and_indorsement; 
        $this->form->formNumber = $nonLifeType->nonLifeInsurance->form_id; 
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
        $this->total = (int)$type->premium + (int)$type->docsStamp + (int)$type->govtax + (int)$type->others;
    }

    public function update(){
        $this->validate();
        $transaction = Transaction::findOrFail($this->selectedRow->id);

        $this->oldExpiration = $transaction->expiration;
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
            "limit_liabilty"=>$this->limitLiability,
            "premium_paid"=>$this->premiumPaid,
            "official_receipt_no"=>$this->form->official_receipt,
            "confirmation_cover_no"=>$this->form->confirmation_no,
            "forms_and_indorsement"=>$this->form->form_endorsement,
            "form_id"=>$this->form->formNumber,
            "paid"=>$this->total,
        ]);

      
        $pdf = new PrintForm($this->selectedRow->non_life_id);
        
        $pdf->generatePdf();
        $pdf->SetTitle('Zilka Life Insurance Form');
        $pdf->output('f','pdfs/zilkaPdf.pdf');

        $this->dispatch('close-modal', name:'pending-form');
        $user =  $this->selectedRow->user()->with('customer')->first();
        if ($this->status == 2) {
            toastr()->success('Insurance Renewed Successfully!');

            RenewedHistory::create([
                'transaction_id' => $this->selectedRow->id,
                'date_expired' =>   $this->oldExpiration,
                'date_renewed' => now()
            ]);

            $message = "Hello ".$user->customer[0]->full_name.", your insurance policy with ZILKA Life Insurance Services has been Renewed . Please review your policy documents for full details. Thank you for trusting us!";

            $this->sendMessage($message,$user->customer[0]->phone_number);
    
            InsuranceApproved::dispatch($this->selectedRow,$this->selectedRow->user()->first(),true);
        } elseif ($this->status == 4) {
            toastr()->success('Insurance Approved Successfully!');

            $message = "Hello ".$user->customer[0]->full_name.", your insurance policy with ZILKA Life Insurance Services has been successfully approved . Please review your policy documents for full details. Thank you for trusting us!";
    
            $this->sendMessage($message,$user->customer[0]->phone_number);
    
            InsuranceApproved::dispatch($this->selectedRow,$this->selectedRow->user()->first());
        } 
        return response()->download( 'pdfs/generatedForm.pdf');

        
    }
    
    public function render()
    {
        return view('livewire.update-non-life-insurance-form');
    }

    
    private function sendMessage($message, $recipients)
        {
            try {
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_number = getenv("TWILIO_NUMBER");
        
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($recipients, 
                    ['from' => $twilio_number, 'body' => $message]);
        
            } catch (\Exception $e) {
                // Log the error and continue
                Log::error("Error sending SMS: " . $e->getMessage());
            }
        }
}
