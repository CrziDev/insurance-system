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

    #[Validate(['primaryPhotos.*' => 'image|max:1024'])]
    public $primaryPhotos = [];

    #[Validate(['secondaryPhotos.*' => 'image|max:1024'])]
    public $secondaryPhotos = [];

    public function fileUpload()
    {
        foreach ($this->primaryPhotos as $photo) {
            $path = $photo->store('public/photos');
            $this->transaction->attachment()->create([
                'attachment_url' => basename($path),
                'type' => 'primary',
            ]);
        }

        foreach ($this->secondaryPhotos as $photo) {
            $path = $photo->store('public/photos');
            $this->transaction->attachment()->create([
                'attachment_url' => basename($path),
                'type' => 'secondary',
            ]);
        }

        $this->transaction->update([
            'status' => 5,
        ]);

        toastr()->success('Claim Requested!');
        $this->redirect('/customer/claims');
        ClaimInsurance::dispatch($this->transaction, Auth::user());
    }

    public function cancelClaim()
    {
        $this->dispatch('close-modal', name: 'claim-add');
    }

    public function removePrimary($index)
    {
        unset($this->primaryPhotos[$index]);
        $this->primaryPhotos = array_values($this->primaryPhotos);
    }

    public function removeSecondary($index)
    {
        unset($this->secondaryPhotos[$index]);
        $this->secondaryPhotos = array_values($this->secondaryPhotos);
    }

    public function render()
    {
        return view('livewire.claim-add');
    }
}
