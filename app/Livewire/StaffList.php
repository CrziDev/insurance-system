<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class StaffList extends Component
{
    public $search;
    public User $selectedStaff;
    protected $queryString = ['search'];


    public function selectStaff(User $staff){
        $this->selectedStaff = $staff;
        $this->dispatch("open-modal",name:"staff-update");
    }
    
    public function addStaff(){
        $this->dispatch("open-modal",name:"staff-add");
    }

    public function render()
    {

        $searchTerm = '%'.$this->search.'%';

        $user = User::where("status",2);

        $user = User::where('username', 'like', $searchTerm)
        ->get();

        return view('livewire.staff-list',['staff'=>$user]);
    }
}
