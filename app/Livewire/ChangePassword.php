<?php

namespace App\Livewire;

use App\Models\customer;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChangePassword extends Component
{
    public User $user;

    #[Validate('required|confirmed|min:3')]
    public $password;
    #[Validate('required|min:3')]
    public $password_confirmation;
    

    public function update(){

        $this->validate();
        $this->user->update([
            'password' => $this->password
        ]);

        toastr()->success('Customer Updated Successfuly!');
        $this->redirect('/admin/customers');
    }

    public function render()
    {
        return view('livewire.change-password');
    }
}
