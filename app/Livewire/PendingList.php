<?php
namespace App\Livewire;

use App\Models\NonLifeInsurance;
use Livewire\Component;

class PendingList extends Component
{   
    public NonLifeInsurance $selectedRow;
    public $tableTitle;
    public $search;
    public $status = ''; // Add this line
    protected $queryString = ['search', 'status'];

    public function selectRow(NonLifeInsurance $selectedRow){

        $this->selectedRow = $selectedRow;
    
        $this->dispatch('open-modal', name:'pending-details');
    }

    public function filterStatus($status){
        $this->status = $status;
    
    }

    public function render()
    {
        $user = request()->user();

        $query = NonLifeInsurance::with('Policy', 'user.customer')
            ->orderByDesc('status');

        if ($user->role == 3) {
            $query->where('user_id', $user->id);
        } else {
            $searchTerm = '%' . $this->search . '%';

            $query->where(function($query) use ($searchTerm) {
                $query->whereHas('Policy', function($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                })
                ->orWhereHas('user.customer', function($q) use ($searchTerm) {
                    $q->where('first_name', 'like', $searchTerm);
                });
            });
        }

        // Apply status filter
        if ($this->status) {
            $query->where('status', $this->status);
        }

        $nonLifeInsurance = $query->get();

        return view('livewire.pending-list', ['data' => $nonLifeInsurance, 'user' => $user]);
    }
}
