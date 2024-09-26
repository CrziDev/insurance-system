<?php

namespace App\Livewire;

use App\Models\Policy;
use Livewire\Component;

class PolicyList extends Component
{
    public $tableTitle;
    public $search;
    protected $queryString = ['search'];

    public function addPolicy(){
        $this->dispatch("open-modal",name:"policy-add");
    }

    public function addQuantity(){
        $this->dispatch("open-modal",name:"policy-add-quantity");
    }
    public function render()
    {
        
        $searchTerm = '%'.$this->search.'%';

         $data = Policy::where('name', 'like', $searchTerm)
            ->orWhere('type', 'like', $searchTerm)
            ->orderBy('id')
            ->get();
            
        return view('livewire.policy-list',['data'=>$data]);
    }
}
