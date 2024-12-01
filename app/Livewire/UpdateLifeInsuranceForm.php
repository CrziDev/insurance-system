<?php

namespace App\Livewire;

use App\Events\InsuranceApproved;
use App\Livewire\Forms\LifeInsuranceAdminAttribute;
use App\Models\LifeInsurance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Twilio\Rest\Client;

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
    public $status;


    public function mount()
    {
        $user = User::with('customer')->find($this->selectedRow->user->id);
        $lifeType = Transaction::with('lifeInsurance')->find($this->selectedRow->id);
        $this->form->full_name = $user->customer[0]->full_name;
        $this->form->mobile_number = $user->customer[0]->phone_number;
        $this->form->email_address = $user->email;
        $this->status = $lifeType->status;

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
        dd($this->selectedRow->user()->first());
        $data = $this->validate();
       
        unset($data['dateEffective'], $data['expiration']);
  
        Transaction::findOrFail($this->selectedRow->id)->update([
            "date_effective"=>$this->dateEffective,
            "expiration"=>$this->expiration,
            "status"=>1,
        ]);

        LifeInsurance::findOrFail($this->selectedRow->life_id)->update($data);

        toastr()->success('Request Approved Successfuly!');

        $user =  $this->selectedRow->user()->with('customer')->first();

        
        $message = "Hello ".$user->customer[0]->full_name.", your insurance policy with ZILKA Life Insurance Services has been successfully approved . Please review your policy documents for full details. Thank you for trusting us!";

        $this->sendMessage($message,$user->customer[0]->phone_number);

        $this->redirect('/admin/request');

        InsuranceApproved::dispatch($this->selectedRow,$this->selectedRow->user()->first());
    }

    public function render()
    {
        return view('livewire.update-life-insurance-form');
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
