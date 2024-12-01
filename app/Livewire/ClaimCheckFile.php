<?php

namespace App\Livewire;

use App\Events\ApprovedClaim;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Twilio\Rest\Client;

class ClaimCheckFile extends Component
{
    use WithFileUploads;
    public Transaction $transaction;
    public $photos = [];

    public function mount(){
        $this->photos = $this->transaction->attachment()->pluck('attachment_url')->toArray();
    }

    public function approveClaim()
    {
      
        $this->transaction->update([
            "status"=>6,
        ]);

        $user =  $this->transaction->user()->with('customer')->first();

        $message = "Hello ".$user->customer[0]->full_name.", your insurance claim with ZILKA Life Insurance Services has been approved . Please review your policy documents for full details. Thank you for trusting us!";

        $this->sendMessage($message,$user->customer[0]->phone_number);



        toastr()->success('Insurance Claim Approved Successfuly!'); 
        
        if(request()->user()->role == 1){
            $this->redirect('/admin/request');
        }elseif(request()->user()->role == 2){
            $this->redirect('/staff/request');
        }

        ApprovedClaim::dispatch($this->transaction,$this->transaction->user()->first());
    }

    public function cancelClaim()
    {
        $this->dispatch('close-modal', name: 'claim-add');
    }
 
 
    public function render()
    {
        return view('livewire.claim-check-file');
    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
                ['from' => $twilio_number, 'body' => $message] );
    }
}
