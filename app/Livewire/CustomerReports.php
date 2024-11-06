<?php

namespace App\Livewire;

use App\Http\Controllers\fpdf186\FPDF;
use App\Models\Transaction;
use Livewire\Component;

class CustomerReports extends Component
{
    public $tableTitle;
    public $data = [];
    public $month = "All";

    public function mount(){
        $this->data = Transaction::with('user','policy')->where('status',3)->get();
    }

    public function optionSelect($month){
        $this->month = $month;
        if($month){
            $this->data = Transaction::with('user','policy')
                ->where('status',1)
                ->whereMonth('created_at','=',$month)
                ->get();
            return;
        }

        $this->data = Transaction::with('user','policy')->where('status',3)->get();
    }

    public function printSales(){
            
        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Times','B',14);
        $pdf->cell(0,0,'Approved Applicants',0,0, 'C');
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

        
        $pdf->SetFont( "Arial", "b", 12 );

        $monthDisplay = $this->month;
        $pdf->SetXY($rectX,$marginTop-8);
        $pdf->Cell($rectWidth*.30,8,'Month: '.$monthDisplay,0,0,'l');

        $pdf->SetFont( "Arial", "b", 7 );
        $pdf->Rect($rectX, $marginTop , $rectWidth*.30, 8);
        $pdf->SetXY($rectX,$marginTop);
        $pdf->Cell($rectWidth*.30,8,'Applicant',0,0,'C');

        $pdf->Rect($rectX + $rectWidth*.30, $marginTop , $rectWidth*.20, 8);
        $pdf->SetXY($rectX + $rectWidth*.30,$marginTop);
        $pdf->Cell($rectWidth*.20,8,'Date Requested ',0,0,'C');


        $pdf->Rect($rectX + $rectWidth*.50, $marginTop , $rectWidth*.50, 8);
        $pdf->SetXY($rectX + $rectWidth*.50,$marginTop);
        $pdf->Cell($rectWidth*.50,8,'Policy',0,0,'C');

        $i = 1;
        foreach ($this->data as $row){
            $pdf->Rect($rectX, $marginTop + (8*$i) , $rectWidth*.30, 8);
            $pdf->SetXY($rectX,$marginTop + (8*$i));
            $pdf->Cell($rectWidth*.30,8,$row->user->customer[0]?->full_name,0,0,'C');
            
            $pdf->Rect($rectX + $rectWidth*.30, $marginTop +(8*$i) , $rectWidth*.20, 8);
            $pdf->SetXY($rectX + $rectWidth*.30,$marginTop +(8*$i));
            $pdf->Cell($rectWidth*.20,8,$row->created_at_format,0,0,'C');
            
            
            $pdf->Rect($rectX + $rectWidth*.50, $marginTop +(8*$i) , $rectWidth*.50, 8);
            $pdf->SetXY($rectX + $rectWidth*.50,$marginTop +(8*$i));
            $pdf->Cell($rectWidth*.50,8,$row->policy->name,0,0,'C');

            $i++;
        }


        $pdf->output('F','pdfs/approveInsurance.pdf');
         return response()->download( 'pdfs/approveInsurance.pdf');
    }

    public function render()
    {
        return view('livewire.customer-reports');
    }
}
