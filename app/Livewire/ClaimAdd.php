<?php

namespace App\Livewire;

use App\Events\ClaimInsurance;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClaimAdd extends Component
{
    use WithFileUploads;
    public Transaction $transaction;


    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];
 
    public function fileUpload()
    {
        foreach ($this->photos as $photo) {
            $path = $photo->store(path: 'public/photos');
            
            $this->transaction->attachment()->create([
                'attachment_url' => basename($path), 
            ]);  
        }
        $this->transaction->update([
            "status"=>5,
        ]);

        toastr()->success('Claim Requested!');
        $this->redirect('/customer/claims');
        ClaimInsurance::dispatch($this->transaction,Auth::user());
        
    }
    
    public function render()
    {
        return view('livewire.claim-add');
    }
}
