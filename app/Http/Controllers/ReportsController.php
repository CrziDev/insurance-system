<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use Illuminate\Http\Request;

class ReportsController
{

    public $year = '2024';

    public function printSales(){

        $pdf = new Fpdf();

        $pdf->AddPage();
        $pdf->SetFont('Times','B',14);
        $pdf->cell(0,0,'Yearly Sales Reports',0,0, 'C');
        $pdf->ln(5);

        $marginLeft = 5;  
        $marginRight = 5;
        $marginTop = 25;
        $marginBottom = 216;
        $pageWidth = $pdf->GetPageWidth();
        $pageHeight = $pdf->GetPageHeight();

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
        $pdf->Cell($rectWidth*.30,8,'Month: '.$this->year,0,0,'l');

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


        $pdf->Rect($rectX, $marginTop+8 , $rectWidth*.10, 12);
        $pdf->SetXY($rectX,$marginTop+8+3);
        $pdf->Multicell($rectWidth*.10,3,"Motorcycle Policy",0,'C');

        $pdf->Rect($rectX, $marginTop+20 , $rectWidth*.10, 12);
        $pdf->SetXY($rectX,$marginTop+20+3);
        $pdf->Multicell($rectWidth*.10,3,"Private Car Policy",0,'C');

        $pdf->Rect($rectX, $marginTop+32 , $rectWidth*.10, 12);
        $pdf->SetXY($rectX,$marginTop+32+3);
        $pdf->Multicell($rectWidth*.10,3,"Commercial Vehicle Policy",0,'C');

        $pdf->Rect($rectX, $marginTop+44 , $rectWidth*.10, 12);
        $pdf->SetXY($rectX,$marginTop+44+3);
        $pdf->Multicell($rectWidth*.10,3,"Private Car Policy",0,'C');


        // $total = 0;
        // for ($i=0; $i < count($motorcyclePolicyData); $i++) { 
        //     $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+8 , ($rectWidth*.0666666666667), 12);
        //     $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+8+5);
        //     $pdf->Multicell(($rectWidth*.0666666666667),3,$motorcyclePolicyData[$i],0,'C');
        //     $total += $motorcyclePolicyData[$i];
        // }
        //     $pdf->Rect($rectX + $rectWidth*.90, $marginTop+8, $rectWidth*.10, 12);
        //     $pdf->SetXY($rectX,$marginTop+8+2);
        //     $pdf->Cell($rectWidth + $rectWidth*.90,8,$total,0,0,'C');

        // $total = 0;
        // for ($i=0; $i < count($month); $i++) { 
        //     $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+20 , ($rectWidth*.0666666666667), 12);
        //     $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+20+5);
        //     $pdf->Multicell(($rectWidth*.0666666666667),3,$privateCarPolicyData[$i],0,'C');

        //     $total += $privateCarPolicyData[$i];
        // }
        //     $pdf->Rect($rectX + $rectWidth*.90, $marginTop+20, $rectWidth*.10, 12);
        //     $pdf->SetXY($rectX,$marginTop+20+2);
        //     $pdf->Cell($rectWidth + $rectWidth*.90,8,$total,0,0,'C');


        // $total = 0;
        // for ($i=0; $i < count($month); $i++) { 
        //     $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+32 , ($rectWidth*.0666666666667), 12);
        //     $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+32+5);
        //     $pdf->Multicell(($rectWidth*.0666666666667),3,$commercialVehiclePolicyData[$i],0,'C');

        //     $total += $commercialVehiclePolicyData[$i];
        // }

        //     $pdf->Rect($rectX + $rectWidth*.90, $marginTop+32, $rectWidth*.10, 12);
        //     $pdf->SetXY($rectX,$marginTop+32+2);
        //     $pdf->Cell($rectWidth + $rectWidth*.90,8,$total ,0,0,'C');


        // $total = 0;
        // for ($i=0; $i < count($month); $i++) { 
        //     $pdf->Rect($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))), $marginTop+44 , ($rectWidth*.0666666666667), 12);
        //     $pdf->SetXY($rectX+$rectWidth*.10 + (($rectWidth*(.0666666666667*$i))),$marginTop+44+5);
        //     $pdf->Multicell(($rectWidth*.0666666666667),3,$landTransportationOperatorsPolicyData[$i],0,'C');

        //     $total += $landTransportationOperatorsPolicyData[$i];
        // }

        $pdf->Rect($rectX + $rectWidth*.90, $marginTop+44, $rectWidth*.10, 12);
        $pdf->SetXY($rectX,$marginTop+44+2);
        // $pdf->Cell($rectWidth + $rectWidth*.90,8,$total ,0,0,'C');

        $pdf->output('i','sales.pdf');
        exit;
    }

    public function loadData($year)
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
        
        $this->data = collect($typeData)->map(function($item, $key) {
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
