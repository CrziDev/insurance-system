<?php

namespace App\Action;

use setasign\Fpdi\Fpdi;

class PrintActionFpdi extends Fpdi
{

    function __construct(){

    }
    public function generatePdf()
    {
        // Create an instance of FPDI
        $fpdi = new Fpdi(); // No need to use the current class as $this is already the FPDI object

        $file = public_path('pdfs/templatePDf.pdf'); // Adjust path accordingly

        $fpdi->AddPage();
        // set the source file
        $fpdi->setSourceFile($file);
        // import page 1
        $tplIdx = $fpdi->importPage(1);
        // use the imported page and place it at position 10,10 with a width of 100 mm
        $fpdi->useTemplate($tplIdx, 10, 10, 100);

        $fpdi->SetFont('Helvetica');
        $fpdi->SetTextColor(255, 0, 0);
        $fpdi->SetXY(30, 30);
        $fpdi->Write(0, 'This is just a simple text');
        
        return $fpdi;
    }
}
