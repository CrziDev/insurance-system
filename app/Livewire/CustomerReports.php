<?php

namespace App\Livewire;

use Fpdf\Fpdf;
use App\Models\Transaction;
use DateTime;
use Livewire\Component;

class CustomerReports extends Component
{
    public $tableTitle;
    public $data = [];
    public $month = "all";
    public $year;

    public function mount(){
        $this->year = now()->format('Y');
        $this->data = Transaction::with('user','policy')->whereIn('status',[3,1])->get();

    }

    public function monthSelect($month){
        $this->month = $month;
        $this->renderFunction();
    }

    public function yearSelect($year){
        $this->year = $year;
        $this->renderFunction();
    }


    public function renderFunction(){
        if($this->month){

            $this->data = Transaction::with('user','policy')
                ->whereIn('status',[3,1])
                ->whereYear('created_at',$this->year)
                ->whereMonth('created_at','=',$this->month)
                ->get();

            return;
        }

        $this->data = Transaction::with('user','policy')->whereIn('status',[3,1])->whereYear('created_at',$this->year)->get();
    }

   public function printSales()
{
    $pdf = new FPDF();
    $path = base_path('/resources/images/logo.png');

    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 14);
    $pdf->Ln(25);
    $pdf->Cell(0, 0, 'Approved Applicants', 0, 0, 'C');
    $pdf->Ln(5);

    $pageWidth = $pdf->GetPageWidth();
    $pageHeight = $pdf->GetPageHeight();

    $marginLeft = 5;
    $marginRight = 5;
    $marginTop = 60;
    $bottomMargin = 20;
    $rowHeight = 8;

    $imageWidth = 30;
    $pdf->Image($path, ($pageWidth / 2) - 17, 0, $imageWidth, 30);

    $rectWidth = $pageWidth - $marginLeft - $marginRight;
    $rectX = $marginLeft;

    // Month/Year display
    $pdf->SetFont("Arial", "b", 10);
    $month = $this->month;
    $year = $this->year;

    if ($month === 'all') {
        $monthDisplay = 'All Months';
        $yearDisplay = $year;
    } else {
        $date = new DateTime("$year-$month-01");
        $monthDisplay = $date->format('F');
        $yearDisplay = $year;
    }

    $pdf->SetXY($rectX, $marginTop - 15);
    $pdf->Cell($rectWidth * 0.30, 8, 'Year: ' . $yearDisplay, 0, 0, 'L');
    $pdf->SetXY($rectX, $marginTop - 10);
    $pdf->Cell($rectWidth * 0.30, 8, 'Month: ' . $monthDisplay, 0, 0, 'L');

    $totalPaid = 0;
    $totalChange = 0;

    // Draw table header
    $drawHeader = function () use ($pdf, $rectX, $marginTop, $rowHeight, $rectWidth) {
        $pdf->SetFont("Arial", "b", 7);
        $pdf->Rect($rectX, $marginTop, $rectWidth * 0.30, $rowHeight);
        $pdf->SetXY($rectX, $marginTop);
        $pdf->Cell($rectWidth * 0.30, $rowHeight, 'Applicant', 0, 0, 'C');

        $pdf->Rect($rectX + $rectWidth * 0.30, $marginTop, $rectWidth * 0.20, $rowHeight);
        $pdf->SetXY($rectX + $rectWidth * 0.30, $marginTop);
        $pdf->Cell($rectWidth * 0.20, $rowHeight, 'Date Requested', 0, 0, 'C');

        $pdf->Rect($rectX + $rectWidth * 0.50, $marginTop, $rectWidth * 0.20, $rowHeight);
        $pdf->SetXY($rectX + $rectWidth * 0.50, $marginTop);
        $pdf->Cell($rectWidth * 0.20, $rowHeight, 'Policy', 0, 0, 'C');

        $pdf->Rect($rectX + $rectWidth * 0.70, $marginTop, $rectWidth * 0.15, $rowHeight);
        $pdf->SetXY($rectX + $rectWidth * 0.70, $marginTop);
        $pdf->Cell($rectWidth * 0.15, $rowHeight, 'Paid', 0, 0, 'C');

        $pdf->Rect($rectX + $rectWidth * 0.85, $marginTop, $rectWidth * 0.15, $rowHeight);
        $pdf->SetXY($rectX + $rectWidth * 0.85, $marginTop);
        $pdf->Cell($rectWidth * 0.15, $rowHeight, 'Change', 0, 0, 'C');

    };

    $drawHeader();

    $i = 1;
    foreach ($this->data as $row) {
    $y = $marginTop + ($i * $rowHeight);

    if ($y + $rowHeight > $pageHeight - $bottomMargin) {
        $pdf->AddPage();
        $pdf->Image($path, ($pageWidth / 2) - 17, 0, $imageWidth, 30);
        $drawHeader();
        $i = 1;
        $y = $marginTop + ($i * $rowHeight);
    }

    $paid = floatval($row->paid ?? 0);
    $change = floatval($row->change ?? 0);
    $totalPaid += $paid;
    $totalChange += $change;

    // Row output
    $pdf->Rect($rectX, $y, $rectWidth * 0.30, $rowHeight);
    $pdf->SetXY($rectX, $y);
    $pdf->Cell($rectWidth * 0.30, $rowHeight, $row->user->customer[0]?->full_name ?? '', 0, 0, 'C');

    $pdf->Rect($rectX + $rectWidth * 0.30, $y, $rectWidth * 0.20, $rowHeight);
    $pdf->SetXY($rectX + $rectWidth * 0.30, $y);
    $pdf->Cell($rectWidth * 0.20, $rowHeight, $row->created_at_format ?? '', 0, 0, 'C');

    $pdf->Rect($rectX + $rectWidth * 0.50, $y, $rectWidth * 0.20, $rowHeight);
    $pdf->SetXY($rectX + $rectWidth * 0.50, $y);
    $pdf->Cell($rectWidth * 0.20, $rowHeight, $paid, 0, 0, 'C');

    $pdf->Rect($rectX + $rectWidth * 0.70, $y, $rectWidth * 0.15, $rowHeight);
    $pdf->SetXY($rectX + $rectWidth * 0.70, $y);
    $pdf->Cell($rectWidth * 0.15, $rowHeight, number_format($paid, 2), 0, 0, 'C');

    $pdf->Rect($rectX + $rectWidth * 0.85, $y, $rectWidth * 0.15, $rowHeight);
    $pdf->SetXY($rectX + $rectWidth * 0.85, $y);
    $pdf->Cell($rectWidth * 0.15, $rowHeight, number_format($change, 2), 0, 0, 'C');

    $i++;
}
$y = $marginTop + ($i * $rowHeight);

$pdf->SetFont("Arial", "b", 8);
$pdf->Rect($rectX, $y, $rectWidth * 0.70, $rowHeight);
$pdf->SetXY($rectX, $y);
$pdf->Cell($rectWidth * 0.70, $rowHeight, 'TOTAL', 0, 0, 'R');

$pdf->Rect($rectX + $rectWidth * 0.70, $y, $rectWidth * 0.15, $rowHeight);
$pdf->SetXY($rectX + $rectWidth * 0.70, $y);
$pdf->Cell($rectWidth * 0.15, $rowHeight, number_format($totalPaid, 2), 0, 0, 'C');

$pdf->Rect($rectX + $rectWidth * 0.85, $y, $rectWidth * 0.15, $rowHeight);
$pdf->SetXY($rectX + $rectWidth * 0.85, $y);
$pdf->Cell($rectWidth * 0.15, $rowHeight, number_format($totalChange, 2), 0, 0, 'C');


    // Prepared by
    $pdf->SetFont("Arial", "b", 12);
    $pdf->SetXY(($rectX + $rectWidth * 0.65), ($pageHeight - $bottomMargin));
    $pdf->Cell($rectWidth * 0.30, 8, 'Prepared by: ' . request()->user()->username, 0, 0, 'L');

    $pdf->Output('F', 'pdfs/approveInsurance.pdf');
    return response()->download('pdfs/approveInsurance.pdf');
}


    public function render()
    {
        return view('livewire.customer-reports');
    }
}
