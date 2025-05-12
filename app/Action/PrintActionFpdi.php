<?php

namespace App\Action;

use App\Models\NonLifeInsurance;
use setasign\Fpdi\Fpdi;

class PrintActionFpdi extends Fpdi
{

    public $fullName;
    public $address;
    public $profession;
    public $conf_cover;
    public $official_receipt;
    public $date_issue;
    public $period_issuance_from;
    public $period_issuance_to;

    public $vehicle_model;
    public $vehicle_platenum;
    public $vehicle_make;
    public $vehicle_chassis;
    public $vehicle_type;
    public $vehicle_motornum;
    public $vehicle_color;
    public $vehicle_blt;
    public $vehicle_weight;
    public $vehicle_total;

    public $form_endorsement;
    public $status;
    public $transaction_number;
    public $transaction_id;
    public $capacity;

    public $vehicle_premium;
    public $vehicle_docstamp;
    public $vehicle_govtax;
    public $vehicle_others;
    public $vehicle_totalpaid;

    public $limitLiability;
    public $premium_paid;
    public $formID;

    public $dateDay;
    public $dateYear;

    public function __construct($insuranceData)
    {
        parent::__construct('P', 'mm', array(210, 297)); 

        $data = NonLifeInsurance::with('user.customer','transaction.policy')->find($insuranceData);

        parent::__construct(); // Call the parent constructor (Fpdf)
        $this->fullName = $data->user->customer[0]->full_name ?? 'name';  // If no full name, set to empty string
        $this->address = $data->user->customer[0]->address ?? '';  // Assuming the address is in customer
        $this->profession = $data->user->customer[0]->profession ?? '';  // Assuming profession is in customer
        $this->conf_cover = $data->confirmation_cover_no ?? '';  // 'endorsement' field from database
        $this->official_receipt = $data->official_receipt_no??'';  // Assuming this is not stored in the migration

        $this->date_issue = now()->toDateString();  // 'date_effective' field from database
        $this->period_issuance_from = $data->transaction->date_effective ?? null; // Assuming effective date is the start date
        $this->period_issuance_to = $data->transaction->expiration ?? null;  // 'expiration' field from database

        // Vehicle details (based on migration fields)
        $this->vehicle_model = $data->model ?? '';  // 'model' field from database
        $this->vehicle_platenum = $data->plate ?? '';  // 'plate' field from database
        $this->vehicle_make = $data->make ?? '';  // 'make' field from database
        $this->vehicle_chassis = $data->serial_chassis ?? '';  // 'serial_chassis' field from database
        $this->vehicle_type = $data->body_type ?? '';  // 'body_type' field from database
        $this->vehicle_motornum = $data->motor_num ?? '';  // 'motor_num' field from database
        $this->vehicle_color = $data->color ?? '';  // 'color' field from database
        $this->vehicle_blt = $data->blt_num ?? '';  // 'blt_num' field from database
        $this->vehicle_weight = $data->weight_capacity ?? '';  // 'weight_capacity' field from database
        $this->vehicle_total = $data->paid ?? '';  // 'paid' field from database

        $this->form_endorsement = $data->forms_and_indorsement ?? '';  // 'endorsement' field from database
        $this->status = $data->transaction->status ?? 1;  // Default status is 1 if not provided
        $this->transaction_number = 1;  // Default transaction number, adjust if needed
        $this->transaction_id = '';  // Assuming this is not in the migration

        $this->capacity = $data->authorize_capacity ?? '';  // 'authorize_capacity' field from database
        
        $this->vehicle_premium = number_format((float) $data->transaction->policy->premium, 2, '.', '') ?? '';  
        $this->vehicle_docstamp = number_format((float) $data->transaction->policy->docstamp, 2, '.', '') ?? '';  
        $this->vehicle_govtax = number_format((float) $data->transaction->policy->govtax, 2, '.', '') ?? '';  
        $this->vehicle_others = number_format((float) $data->transaction->policy->others, 2, '.', '') ?? '';  
        $this->vehicle_totalpaid = number_format(
              (float) $data->transaction->policy->premium 
            + (float) $data->transaction->policy->docstamp 
            + (float) $data->transaction->policy->govtax 
            + (float) $data->transaction->policy->others,
            2
        );  
        $this->limitLiability = $data->limit_liabilty ?? '';  // 'limit_liabilty' field from database
        $this->premium_paid = $data->premium_paid ?? '';  // 'paid' field from database
        $this->formID = $data->form_id??'';  // Assuming form ID is not stored

        $yrdata = strtotime(date("Y/m/d"));
        $this->dateDay = date('d', $yrdata);
        $this->dateYear = date('M, Y', $yrdata); 
    }

    public function generatePdf($short = false)
    {


        $marginLeft = 10;  
        $marginRight = 10;
        $marginTop = 50;
        $marginBottom = 40;
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
        
        $rectWidth = $pageWidth - $marginLeft - $marginRight;
        $rectHeight = $pageHeight - $marginTop - $marginBottom;
        $rectX = $marginLeft;
        $rectY = $marginLeft;


        $this->AddPage();

        
        // $this->setSourceFile();
        // $tplId = $this->importPage(1);

        // $this->useTemplate($tplId, 0, 0, 210, 297);
        
            $this->SetFont("Arial", "", 12);
            // $this->SetXY(($rectX+ $rectWidth-($rectWidth*.25)) , ($marginTop)-12);
            // $this->Cell(50,15,$this->formID,0,0,'C');

        // NAME AND ADDRESS OF INSURED
        $this->SetXY(($rectX),($marginTop + 4));
        $this->MultiCell(($rectWidth*.50),4,$this->fullName ,0,'C',false);

        $this->SetXY(($rectX),($marginTop + 10));
        $this->MultiCell(($rectWidth*.50),4,$this->address ,0,'C',false);

         //BUSINESS PROFESSION
         $this->SetXY(($rectX+$rectWidth*.55),($marginTop-4));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->profession,0,0,'C');

              
         // OFFICIA RECEIPT NO
         $this->SetXY(($rectX+$rectWidth*.75),($marginTop - 4));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->official_receipt,0,0,'C');
         
         // DATE ISSUED
         $this->SetXY(($rectX+$rectWidth*.55),($marginTop+5));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->date_issue,0,0,'C');

         
        //CONFIRMATION OF COVER NO
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop+5));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->conf_cover,0,0,'C');
         

        // FROM
        $this->SetXY(($rectX+$rectWidth*.55),($marginTop + 24));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->period_issuance_from,0,0,'C');
          
         // to 
         $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 24));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->period_issuance_to,0,0,'C');
         
         
         // Model
         $this->SetXY(($rectX-5),($marginTop + 40));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.15),15,$this->vehicle_model,0,0,'C');
         
         // Make
         $this->SetXY(($rectX+$rectWidth*.10),($marginTop + 40));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->vehicle_make,0,0,'C');
         
         
         // TYPE OF BODY
         $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 40));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->vehicle_type,0,0,'C');
         
         
         // COLOR 
         $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 40));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->vehicle_color,0,0,'C');
         
         
         // BLT FILE NO
         $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 40));
         $this->SetFont( "Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->vehicle_blt,0,0,'C');
         
         
         //PLATE NO.
         $this->SetXY(($rectX-5),($marginTop + 50));
         $this->SetFont("Arial", "B", 10);
         $this->Cell(($rectWidth*.15),15,$this->vehicle_platenum,0,0,'C');
         
         
         //SERIAL/ChASSIS NO.
         $this->SetXY(($rectX+$rectWidth*.12),($marginTop + 50));
         $this->SetFont("Arial", "B", 10);
         $this->Cell(($rectWidth*.25),15,$this->vehicle_chassis,0,0,'C');
         
         //MOTOR NO.
         $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 50));
         $this->SetFont("Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->vehicle_motornum,0,0,'C');
         
         //AUTHORIZED CAPACITy.
         $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 50));
         $this->SetFont("Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->capacity,0,0,'C');
         
         //UNLADEN WEIGHT (Kgs).
         $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 50));
         $this->SetFont("Arial", "B", 10);
         $this->Cell(($rectWidth*.20),15,$this->vehicle_weight,0,0,'C');
         
         
      
         $this->SetFont( "Arial", "B", 10);
        //  $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 68));
        //  $this->Cell(50,12,$this->limitLiability,0,0,'l');
         $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 78));
         $this->Cell(50,12,$this->premium_paid,0,0,'l');
         //  //PREMIUM 
         
         if(!$short){
            
            $this->SetXY(($rectX+30),($marginTop + 188));
            $this->SetFont( "Arial", "B", 10);
            $this->Cell(50,2,$this->form_endorsement,0,0,'l');
            

            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 165));
            $this->SetFont("Arial", "B", 12);
            $this->Cell($rectWidth*.30,12,$this->vehicle_totalpaid,0,0,'C');
            
            
            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 196));
            $this->SetFont("Arial", "B", 10);
            $this->Cell(20,12,$this->dateDay,0,0,'C');
            
            $this->SetXY(($rectX+$rectWidth*.05),($marginTop + 200));
            $this->SetFont("Arial", "B", 10);
            $this->Cell(20,12,$this->dateYear,0,0,'C');
            
            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 100));
            $this->SetFont("Arial", "B", 12);
            $this->Cell(($rectWidth*.30),15,$this->vehicle_premium,0,0,'C');
            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 115));
            $this->SetFont("Arial", "B", 12);
            $this->Cell(($rectWidth*.30),15,$this->vehicle_docstamp,0,0,'C');
            
            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 130));
            $this->SetFont("Arial", "B", 12);
            $this->Cell(($rectWidth*.30),15,$this->vehicle_govtax,0,0,'C');
            $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 145));
            $this->SetFont("Arial", "B", 12);
            $this->Cell(($rectWidth*.30),15,$this->vehicle_others,0,0,'C');
        }

    }
}
