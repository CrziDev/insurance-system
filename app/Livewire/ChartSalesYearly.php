<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartSalesYearly extends Component
{   
    public $dataYearly = [];
    public $yearSet = [];
    public $startYear;
    public $endYear;
    public $tableTitle;

    public function mount($startYear = null, $endYear = null) {
        $this->startYear = $startYear ?? now()->subYear()->format('Y'); // Default to last year
        $this->endYear = $endYear ?? now()->format('Y'); // Default to current year
        $this->loadData();
    }

    public function loadData()
    {
        $transactions = DB::table('transactions as tr')
            ->select(
                DB::raw('SUM(nI.paid) as total_paid'),
                'pol.type as type',
                DB::raw('YEAR(tr.created_at) AS year') // Use YEAR() to get the year of the transaction
            )
            ->join('non_life_insurances as nI', 'nI.id', '=', 'tr.non_life_id')
            ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
            ->whereBetween(DB::raw('YEAR(tr.created_at)'), [$this->startYear, $this->endYear])
            ->groupBy( 'pol.type','year')
            ->get();

            
            $transactions2 = DB::table('transactions as tr')
            ->select(
                    DB::raw('300 as total_paid'), // Default value for life insurance
                    'pol.type as type',
                    DB::raw('YEAR(tr.created_at) AS year') // Use YEAR() to get the year of the transaction
                )
                ->join('life_insurances as li', 'li.id', '=', 'tr.life_id')
                ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
                ->whereBetween(DB::raw('YEAR(tr.created_at)'), [$this->startYear, $this->endYear])
                ->groupBy( 'pol.type','year')
                ->get();
                
                // Merge both transaction sets
            $transactions = $transactions->merge($transactions2);
                
        

            
        $typeData = [];
            
        $transactions->each(function ($item) use (&$typeData) {
            if (!isset($typeData[$item->type])) {
                $typeData[$item->type] = array_fill_keys(range($this->startYear, $this->endYear), 0);
            }
        });

        $transactions->each(function ($item) use (&$typeData) {
            $monthIndex = $item->year;
            $typeData[$item->type][$monthIndex] += $item->total_paid;
        });
        

    
        $this->dataYearly = collect($typeData)->map(function($item, $key) {
            $randomColor = function() {
                $r = rand(0, 255);
                        $g = rand(0, 255);
                        $b = rand(0, 255);
                        return "rgba($r, $g, $b, 0.2)";
                    };
                    
                    return [
                        'type' => 'bar',
                        'label' => $key,
                        'data' => $item, 
                        'backgroundColor' => $randomColor(),
                        'borderColor' => "rgba(54, 162, 235, 1)", 
                        'borderWidth' => 1,
                        'stack' => 'combined',
                    ];
                })->values();


    }

    public function selectOptionsYearly($startYear = null, $endYear = null)
    {
        $this->startYear = $startYear ?? $this->startYear;
        $this->endYear = $endYear ?? $this->endYear;
    
        $this->loadData();
    
        $this->dispatch('updateChartYearly', [
            'datasets' => $this->dataYearly,
            'labels' => $this->yearSet, 
        ]);
    }


    public function render()
    {
        return view('livewire.chart-sales-yearly',[
            'chartDataYearly' => $this->dataYearly,
        ]);
    }
}
