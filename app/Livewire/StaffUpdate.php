<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StaffUpdate extends Component
{

    public User $selectedStaff;
    #[Validate('required|email|max:255')]
    public $email;
    #[Validate('required|min:3')]
    public $username;
    
    public function boot(){
        $this->username = $this->selectedStaff->username;
        $this->email = $this->selectedStaff->email;

    }


    
    public function update(){
        $validated = $this->validate();

        $user = User::find($this->selectedStaff->id);
        $user->update($this->mapedUserAttribute($validated));

        toastr()->success('Customer Updated Successfuly!');
        $this->redirect('/admin/staff');
    }


    
    public function mapedUserAttribute($data){

        return [
            'username'=>$data['username'],
            'email'=>$data['email']
        ];
    }

    public function render()
    {
        return view('livewire.staff-update');
    }
}
