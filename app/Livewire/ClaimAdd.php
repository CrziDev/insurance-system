<?php

namespace App\Livewire;

use App\Models\Transaction;
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

        toastr()->success('Insurance Claimed Successfuly!');
        $this->redirect('/customer/claims');
    }
    
    public function render()
    {
        return view('livewire.claim-add');
    }
}
