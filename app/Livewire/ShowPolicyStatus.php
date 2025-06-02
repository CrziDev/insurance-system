<?php

namespace App\Livewire;

use App\Action\PrintActionFpdi;
use App\Action\PrintForm;
use App\Models\customer;
use App\Models\NonLifeInsurance;
use App\Models\Transaction;
use Livewire\Component;

class ShowPolicyStatus extends Component
{
    public customer $selectedCustomer;
    public Transaction $selectedRow;
    public $fullName;
    public $data = [];


    public function selectRow(Transaction $selectedRow){
        $this->selectedRow = $selectedRow;  
        $this->dispatch('open-modal-child',name:'view-insurance');
    }
    
    public function addInsurance($type){
        if($type == 'non-life'){
            $this->dispatch('open-modal-child',name:'add-non-life-insurance');
        } 
        
        if($type == 'life'){
            $this->dispatch('open-modal-child',name:'add-life-insurance');
        }   
    }

    public function printShortForm($selectedRow)
    {

        $pdf = new PrintForm($selectedRow["non_life_id"]); 
    
        $uniquePdfName = 'zilkaPdf_short_form' . time() . '.pdf'; 

        $pdf->generatePdf(true);
        $pdf->SetTitle('Zilka Life Insurance Form');
        $pdf->output('f', 'pdfs/' . $uniquePdfName); 

        $this->dispatch('openPdfInNewTab', asset('pdfs/' . $uniquePdfName)); 

    }

    public function boot(){
        $this->data = Transaction::with('Policy')
        ->where('user_id',$this->selectedCustomer->user->id)
        ->whereIn('status',[1,2,3])
        ->orderBydesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.show-policy-status');
    }
}
