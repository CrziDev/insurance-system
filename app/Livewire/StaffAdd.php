<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;


class StaffAdd extends Component
{

    #[Validate('required|min:3')]
    public $username;
    #[Validate('required|confirmed|min:3')]
    public $password;
    #[Validate('required|min:3')]
    public $password_confirmation;
    #[Validate('required|email|max:255|unique:users')]
    public $email;


    
    public function save(){
        $validated = $this->validate();

        User::create($this->mapedUserAttribute($validated));

        toastr()->success('Staff Added Successfuly!');
        $this->redirect('/admin/staff');
    }


    public function mapedUserAttribute($data){

        return [
            'username'=>$data['username'],
            'password'=>$data['password'],
            'role'=>2,
            'email'=>$data['email']
        ];
    }

    public function render()
    {
        return view('livewire.staff-add');
    }
}
