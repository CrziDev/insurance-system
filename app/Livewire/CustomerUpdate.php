<?php

namespace App\Livewire;

use App\Models\customer;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CustomerUpdate extends Component
{

    public customer $selectedCustomer;
    #[Validate('required|min:3')]
    public $username;
    #[Validate('required|min:3')]
    public $firstName;
    #[Validate('required|min:3')]
    public $lastName;
    #[Validate('required')]
    public $middleInitial = 'N/A';
    #[Validate('required')]
    public $nameExtention = "N/A";
    #[Validate('required|min:3')]
    public $phoneNumber;
    #[Validate('required|email|max:255')]
    public $email;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $profession;


    public function boot(){
        $this->username = $this->selectedCustomer->user->username;
        $this->firstName = $this->selectedCustomer->first_name;
        $this->lastName = $this->selectedCustomer->last_name;
        $this->middleInitial = $this->selectedCustomer->middle_initial;
        $this->email = $this->selectedCustomer->user->email;
        $this->nameExtention = $this->selectedCustomer->name_extention;
        $this->address = $this->selectedCustomer->address;
        $this->profession = $this->selectedCustomer->profession;
        $this->phoneNumber = $this->selectedCustomer->phone_number;


    }

    public function update(){
        $validated = $this->validate();

        $user = User::find($this->selectedCustomer->user->id);
        $user->update($this->mapedUserAttribute($validated));


        $customer = Customer::find($this->selectedCustomer->id);
        $customer->update($this->mapedUserInformation($validated));


        toastr()->success('Customer Updated Successfuly!');
        $this->redirect('/admin/customers');
    }

    public function mapedUserAttribute($data){

        return [
            'username'=>$data['username'],
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
        ];
    }

    public function render()
    {
        return view('livewire.customer-update');
    }
}
