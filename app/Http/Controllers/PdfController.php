<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\NonLifeInsurance;
use App\Services\PrintForm;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function previewPdf()
    {

        $pdfFile = 'pdfs/zilkaPdf.pdf';
        return view('pdf-preview.preview',compact('pdfFile'));
        
    }

}
