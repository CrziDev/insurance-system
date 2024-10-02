<?php

namespace App\Livewire;

use App\Models\LifeInsurance;
use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;

class ExpiringList extends Component
{
    public Transaction $selectedRow;
    public $tableTitle;
    public $search;
    public $status = '';
    protected $queryString = ['search', 'status'];

    public function selectRow(Transaction $selectedRow)
    {
        
        $this->selectedRow = $selectedRow;
        $this->dispatch('open-modal', name: 'show-status-details');
  
    }

    public function filterStatus($status)
    {
        $this->status = $status;
    }

    public function render()
    {
        $user = request()->user();
        $searchTerm = '%'.$this->search.'%';

        $transactions = Transaction::whereIn('status',[2,3])->with('policy', 'nonLifeInsurance','lifeInsurance','user')
        ->orderByDesc('status');

        if ($this->status) {
            $transactions->where('status', $this->status);
        }

        

        $transactions->where(function ($query) use ($searchTerm) {
            $query->whereHas('policy', function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm);
            })
            ->orWhereHas('user.customer', function ($q) use ($searchTerm) {
                $q->where('first_name', 'like', $searchTerm);
            });
        });


        return view('livewire.expiring-list', ['data' => $transactions->get(), 'user' => $user]);
    }
}
