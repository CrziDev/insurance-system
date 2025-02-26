<?php

namespace App\Livewire;

use App\Models\Staff;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;


class StaffAdd extends Component
{

    #[Validate('required|unique:users|min:3')]
    public $username;
    #[Validate('required|confirmed|min:3')]
    public $password;
    #[Validate('required|min:3')]
    public $password_confirmation;
    #[Validate('required|email|max:255|unique:users')]
    public $email;
    #[Validate('required|min:3')]
    public $firstName;
    #[Validate('required|min:3')]
    public $lastName;
    #[Validate('required')]
    public $middleInitial = 'N/A';
    #[Validate('required')]
    public $nameExtention = "N/A";
    #[Validate('required|regex:/^\+63\d{10}$/')]
    public $phoneNumber;
    #[Validate('required|min:3')]
    public $address;
    #[Validate('required')]
    public $profession;

    
    public function save(){
        $validated = $this->validate();

        $user = User::create($this->mapedUserAttribute($validated));
        $validated['user_id'] = $user->id;
        Staff::create($this->mapedUserInformation($validated));

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

    public function mapedUserInformation($data){

        return [
            'first_name'=>$data['firstName'],
            'last_name'=>$data['lastName'],
            'middle_initial'=>$data['middleInitial'],
            'name_extention'=>$data['nameExtention'],
            'phone_number'=>$data['phoneNumber'],
            'address'=>$data['address'],
            'profession'=>$data['profession'],
            'user_id'=>$data['user_id']
        ];
    }

    public function render()
    {
        return view('livewire.staff-add');
    }
}
