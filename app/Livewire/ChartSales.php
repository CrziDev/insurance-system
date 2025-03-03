<?php

namespace App\Livewire;

use Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChartSales extends Component
{   

    public $saleChartData = [];
    public $saleChartLabel = [];
    public $salePdfData = [];
    public $tableTitle = '';
    public $year;
    
    public function mount() {
        $this->year = 2024;
        $this->loadData();
    }
        
    public function loadData(){

        $transactions = DB::table('transactions as tr')
            ->join('non_life_insurances as nI', 'nI.id', '=', 'tr.non_life_id')
            ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
            ->select('pol.name as type')
            ->whereYear('tr.created_at',$this->year)
            ->get();
        
        $data = [];
        $label = [];

        $transactions->groupBy('type')->each(function($item) use(&$data,&$label){
           $data [] = $item->count();
           $label [] = $item[0]->type;
        });

        $this->saleChartData = $data;
        $this->saleChartLabel = $label;
    }
    
    public function selectOptions($year)
    {
        $this->year = $year;
        $this->loadData(); 
        
        $this->dispatch('updateChart', [
            'datasets' => $this->saleChartData,
            'labels' => $this->saleChartLabel

        ]);

    }

    public function printSales(){

        $this->pdfData();

        $pdf = new FPDF();
        $path = base_path('/resources/images/logo.png');

        $pdf->AddPage();
        $pdf->SetFont('Times','B',14);
        $pdf->ln(25);
        $pdf->cell(0,0,'Yearly Sales Reports',0,0, 'C');
        $pdf->ln(5);

        $marginLeft = 5;  
        $marginRight = 5;
        $marginTop = 50;
        $marginBottom = 216;
        $pageWidth = $pdf->GetPageWidth();
        $pageHeight = $pdf->GetPageHeight();

        $imageWidth = 30;
        $pdf->Image($path, ($pageWidth/2)-17, 0,$imageWidth,30);


        $rectWidth = $pageWidth - $marginLeft - $marginRight;
        $rectHeight = $pageHeight - $marginTop - $marginBottom;
        $rectX = $marginLeft;
        $rectY = $marginLeft;

        // $pdf->Rect($rectX, $marginTop , $rectWidth, $rectHeight);

        $month =  [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        $pdf->SetFont( "Arial", "b", 12 );


        $pdf->SetXY($rectX,$marginTop-8);
        $pdf->Cell($rectWidth*.30,8,'Year: '.$this->year,0,0,'l');

        $pdf->SetFont( "Arial", "b", 7 );

        $pdf->Rect($rectX, $marginTop , $rectWidth*.10, 8);
        $pdf->SetXY($rectX,$marginTop);
        $pdf->Cell($rectWidth*.10,8,'Policy',0,0,'C');

        $pdf->Rect($rectX + $rectWidth*.90, $marginTop , $rectWidth*.10, 8);
        $pdf->SetXY($rectX,$marginTop);
        $pdf->Cell($rectWidth + $rectWidth*.90,8,'Total',0,0,'C');

        for ($i=0; $i < count($month); $i++) { 
            $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop , ($rectWidth*.0666666666667), 8);
            $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop);
            $pdf->Cell(($rectWidth*.0666666666667),8,$month[$i],0,0,'C');
        
        }

        foreach($this->salePdfData as $index => $data){
            $margin = 8 + (12 * $index); 
            $pdf->Rect($rectX, $marginTop+$margin, $rectWidth*.10, 12);
            $pdf->SetXY($rectX,$marginTop+$margin+3);
            $pdf->Multicell($rectWidth*.10,3,$data['label'],0,'C');

            $total = 0;
            for ($i=0; $i < count($data['data']); $i++) { 
                $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+$margin  , ($rectWidth*.0666666666667), 12);
                $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+ $margin +5);
                $pdf->Multicell(($rectWidth*.0666666666667),3,number_format($data['data'][$i],2),0,'C');
                $total += $data['data'][$i];
            }
                $pdf->Rect($rectX + $rectWidth*.90, $marginTop+$margin, $rectWidth*.10, 12);
                $pdf->SetXY($rectX,$marginTop+ $margin +2);
                $pdf->Cell($rectWidth + $rectWidth*.90,8,number_format($total,2),0,0,'C');

            if($index == count($this->salePdfData) - 1 ){
                $value = array_fill(0,12,0);
                collect($this->salePdfData)->pluck('data')->each(function ( $item) use (&$value) {
                    collect($item)->each(function ( $item,$key) use(&$value) {
                        $value[$key] = (int)$value[$key] + (int)$item;
                    });
                });

                $margin = 8 + (12 * ($index + 1)); 
                $pdf->Rect($rectX, $marginTop+$margin, $rectWidth*.10, 12);
                $pdf->SetXY($rectX,$marginTop+$margin+3);
                $pdf->Multicell($rectWidth*.10,3,'Monthly Total',0,'C');

                foreach($value as $i => $data){
                    $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+$margin  , ($rectWidth*.0666666666667), 12);
                    $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+ $margin +5);
                    $pdf->Multicell(($rectWidth*.0666666666667),3,$data,0,'C');
                }
                
                $pdf->Rect($rectX + $rectWidth*.90, $marginTop+$margin, $rectWidth*.10, 12);
                $pdf->SetXY($rectX,$marginTop+ $margin +2);
                $pdf->Cell($rectWidth + $rectWidth*.90,8,number_format(array_sum($value),2),0,0,'C');
            }

        }

        $pdf->SetFont( "Arial", "b", 12 );
        $pdf->SetXY(($rectX+$rectWidth*.65),($marginTop + 210));
        $pdf->Cell($rectWidth*.30,8,'Prepared by: '.request()->user()->username,0,0,'l');

        $pdf->output('F','pdfs/sales.pdf');
            return response()->download( 'pdfs/sales.pdf');

    }

    public function render()
    {
        return view('livewire.chart-sales',[
            'chartData' => $this->saleChartData,
        ]);
    }


    public function pdfData()
        {
            $transactions = DB::table('transactions as tr')
            ->select(
                DB::raw('SUM(nI.paid) as total_paid'),
                'pol.name as type',
                DB::raw('DATE_FORMAT(nI.created_at, "%m") AS month')
            )
            ->join('non_life_insurances as nI', 'nI.id', '=', 'tr.non_life_id')
            ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
            ->whereYear('tr.created_at',$this->year)
            ->groupBy('pol.name', 'month')
            ->get();

        //    Transaction 2: Life insurances (no paid column)
        $transactions2 = DB::table('transactions as tr')
        ->select(
            DB::raw('300 as total_paid'), // Default value for life insurance
            'pol.name as type',
            DB::raw('DATE_FORMAT(li.created_at, "%m") AS month') // Assuming 'created_at' exists for life insurances
        )
        ->join('life_insurances as li', 'li.id', '=', 'tr.life_id')
        ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
        ->whereYear('tr.created_at', $this->year)
        ->groupBy('pol.name', 'month')
        ->get();
    
            // Merge both transaction sets
            $transactions = $transactions->merge($transactions2);
                
            $typeData = [];
            
            $transactions->each(function ($item) use (&$typeData) {
                if (!isset($typeData[$item->type])) {
                    $typeData[$item->type] = array_fill(0, 12, 0); 
                }
            });
            
            $transactions->each(function ($item) use (&$typeData) {
                $monthIndex = (int)$item->month - 1;
                $typeData[$item->type][$monthIndex] += $item->total_paid;
            });
            
            
            $this->salePdfData = collect($typeData)->map(function($item, $key) {
                // Function to generate a random RGB color
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
}



// public $data = [];
//     public $year;
//     public $tableTitle;

//     public function mount() {
//         $this->year = now()->format('Y');
//         $this->loadData();

//     }

//     public function loadData()
//         {
//             $transactions = DB::table('transactions as tr')
//             ->select(
//                 DB::raw('SUM(nI.paid) as total_paid'),
//                 'pol.name as type',
//                 DB::raw('DATE_FORMAT(nI.created_at, "%m") AS month')
//             )
//             ->join('non_life_insurances as nI', 'nI.id', '=', 'tr.non_life_id')
//             ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
//             ->whereYear('tr.created_at',$this->year)
//             ->groupBy('pol.name', 'month')
//             ->get();

//         //    Transaction 2: Life insurances (no paid column)
//         $transactions2 = DB::table('transactions as tr')
//         ->select(
//             DB::raw('300 as total_paid'), // Default value for life insurance
//             'pol.name as type',
//             DB::raw('DATE_FORMAT(li.created_at, "%m") AS month') // Assuming 'created_at' exists for life insurances
//         )
//         ->join('life_insurances as li', 'li.id', '=', 'tr.life_id')
//         ->join('policies as pol', 'pol.id', '=', 'tr.policy_type_id')
//         ->whereYear('tr.created_at', $this->year)
//         ->groupBy('pol.name', 'month')
//         ->get();
    
//             // Merge both transaction sets
//             $transactions = $transactions->merge($transactions2);
                
//             $typeData = [];
            
//             $transactions->each(function ($item) use (&$typeData) {
//                 if (!isset($typeData[$item->type])) {
//                     $typeData[$item->type] = array_fill(0, 12, 0); 
//                 }
//             });
            
//             $transactions->each(function ($item) use (&$typeData) {
//                 $monthIndex = (int)$item->month - 1;
//                 $typeData[$item->type][$monthIndex] += $item->total_paid;
//             });
            
            
//             $this->data = collect($typeData)->map(function($item, $key) {
//                 // Function to generate a random RGB color
//                 $randomColor = function() {
//                     $r = rand(0, 255);
//                             $g = rand(0, 255);
//                             $b = rand(0, 255);
//                             return "rgba($r, $g, $b, 0.2)";
//                         };
                        
//                         return [
//                             'type' => 'bar',
//                             'label' => $key,
//                             'data' => $item, 
//                             'backgroundColor' => $randomColor(),
//                             'borderColor' => "rgba(54, 162, 235, 1)", 
//                             'borderWidth' => 1,
//                             'stack' => 'combined',
//                         ];
//                     })->values();

//         }

//     public function selectOptions($year)
//     {

//         $this->loadData($year); 

//         $this->dispatch('updateChart', [
//             'datasets' => $this->data,
//             'labels' => [
//                 "January", "February", "March", "April",
//                 "May", "June", "July", "August",
//                 "September", "October", "November", "December",
//             ],
//         ]);
    
//     }