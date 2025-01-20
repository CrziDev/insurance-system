<?php

namespace App\Livewire;

use App\Models\Staff;
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

    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $profession;
    
    public function boot(){
        $this->username = $this->selectedStaff->username;
        $this->email = $this->selectedStaff->email;
       
        $this->username = $this->selectedStaff->username;
        $this->firstName = $this->selectedStaff->staff?->first_name;
        $this->lastName = $this->selectedStaff->staff?->last_name;
        $this->middleInitial = $this->selectedStaff->staff?->middle_initial;
        $this->nameExtention = $this->selectedStaff->staff?->name_extention;
        $this->address = $this->selectedStaff->staff?->address;
        $this->profession = $this->selectedStaff->staff?->profession;
        $this->phoneNumber = $this->selectedStaff->staff?->phone_number;

    }


    
    public function update(){
        $validated = $this->validate();

        $user = User::find($this->selectedStaff->id);
        $user->update($this->mapedUserAttribute($validated));

        $staff = Staff::where('user_id',$this->selectedStaff->id)->first();

        if(!$staff){
            Staff::create([...$this->mapedUserInformation($validated),'user_id'=>$user->id]);
        }else{
            $staff->update($this->mapedUserInformation($validated));
        }

        toastr()->success('Customer Updated Successfuly!');
        $this->redirect('/admin/staff');
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
        return view('livewire.staff-update');
    }
}
