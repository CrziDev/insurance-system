<?php

namespace App\Livewire;

use App\Models\customer;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CustomersList extends Component
{

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
    #[Validate('required|email|max:255|unique:users')]
    public $email;
    #[Validate('required|min:3')]
    public $address;
    #[Validate('required|min:3')]
    public $profession;
    public $fullName;

    public $search;
    protected $queryString = ['search'];


    public customer $selectedCustomer;

    public function selectCustomer(customer $customer){
        $this->selectedCustomer = $customer;
        $this->dispatch("open-modal",name:"update-customer");
    }
    
    public function addCustomer(){
        $this->dispatch("open-modal",name:"customer-add");
    }
    public function updatePassword(customer $customer){
        $this->selectedCustomer = $customer;
        $this->dispatch("open-modal",name:"update-password");
    }
    
    public function showPolicy(customer $customer){
        $this->fullName = $customer->full_name;
        $this->selectedCustomer = $customer;
        $this->dispatch("open-modal",name:"show-policy");
    }

    public function render()    
    {
        $searchTerm = '%'.$this->search.'%';

        $customers = customer::where('first_name', 'like', $searchTerm)
        ->orWhere('last_name', 'like', $searchTerm)
        ->orderBy('created_at','desc')
        ->get();
        return view('livewire.customers-list',['customers'=>$customers]);

    }
}
