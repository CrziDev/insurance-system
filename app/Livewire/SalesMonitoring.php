<?php
namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SalesMonitoring extends Component
{
    public $tableTitle;
    public $salesData;
    public $saleLabel;


    public function mount() {
        $this->loadData();
    }

    public function loadData()
    {

        $transactions = DB::table('transactions as tr')
        ->select(
            DB::raw('COUNT(tr.status) as status_count'),
           'tr.status as status',
             // Use YEAR() to get the year of the transaction
        )
        ->whereIn('tr.status',[1,2,3,4,5])
        ->groupBy('status')
        ->get();

         // Map status numbers to text
         $statusMap = [
            1 => 'Approved',
            2 => 'Expired',
            3 => 'Expiring',
            4 => 'Pending',
            5 => 'Claimed'
        ];

        // Initialize arrays for labels and sales data
        $labels = [];
        $data = [];

        // Loop through the transactions and build the arrays
        foreach ($transactions as $transaction) {
            // Convert the status number to its corresponding text
            $labels[] = $statusMap[$transaction->status];
            $data[] = $transaction->status_count;
        }

        // Assign the labels and data to the properties for use in the view
        $this->saleLabel = $labels;
        // Here, you can modify the data format to match your requirements.
        $this->salesData = [
            'label' => 'Status Count',
            'data' => $data,
            'borderColor' => "rgba(54, 162, 235, 1)", 
            'fill' => false,
            'tension' => 0.1, // Removed quotes from the numeric value
        ];
    }

    public function render()
    {
        return view('livewire.sales-monitoring', [
            'salesMonitoring' => $this->salesData,
        ]);
    }
}
