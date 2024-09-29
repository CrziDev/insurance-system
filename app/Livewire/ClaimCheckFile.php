<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

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

        toastr()->success('Insurance Claim Approved Successfuly!');
        $this->redirect('/admin/claims');
    }
 
    public function render()
    {
        return view('livewire.claim-check-file');
    }
}
