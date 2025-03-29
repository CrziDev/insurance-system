<?php
namespace App\Action;

use App\Models\NonLifeInsurance;
use Fpdf\Fpdf;

class PrintForm extends Fpdf
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
     public $vehicle_paid;
     public $formID;
 
     public $dateDay;
     public $dateYear;
 
     // Constructor to initialize the class properties
     function __construct($insuranceData)
     {

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

        $this->form_endorsement = $data->form_endorsement ?? '';  // 'endorsement' field from database
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
            + (float) $data->transaction->policy->others
            + (float) $data->transaction->policy->others
            + (float) $data->limit_liabilty
            + (float) $data->premium_paid, 
            2
        );  
        $this->limitLiability = $data->limit_liabilty ?? '';  // 'limit_liabilty' field from database
        $this->vehicle_paid = $data->premium_paid ?? '';  // 'paid' field from database
        $this->formID = $data->form_id??'';  // Assuming form ID is not stored

        // Date-related properties
        $yrdata = strtotime(date("Y/m/d"));
        $this->dateDay = date('d', $yrdata);
        $this->dateYear = date('M, Y', $yrdata);    
     }

    function Footer()
    {
        $marginLeft = 10;  
        $marginRight = 10;
        $marginTop = 25;
        $marginBottom = 40;
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();

        $rectWidth = $pageWidth - $marginLeft - $marginRight;
        $rectHeight = $pageHeight - $marginTop - $marginBottom;

        $this->SetXY($pageWidth-90,$pageHeight-28);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(50,12,'UCPB GENERAL INSURANCE COMPANY, INC',0,0,'l');

        
        $this->SetXY($pageWidth-80,$pageHeight-20);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(50,12,'ATTY. DARREN M. DE JESUS',0,0,'l');
        $this->SetXY($pageWidth-80,$pageHeight-20);
        $this->SetFont("Arial", "B", 10);
        $this->Cell(50,12,'_________________________',0,0,'l');
        $this->SetXY($pageWidth-65,$pageHeight-15);
        $this->SetFont("Arial", "", 10);
        $this->Cell(50,12,'PRESIDENT',0,0,'l');
    
    }

    public function generatePdf(){
        $this->AddPage();
        $this->SetFont('Times','B',14);
        $this->cell(0,0,'PRIVATE CAR POLICY',0,0, 'C');
        $this->ln(5);
        
        $marginLeft = 10;  
        $marginRight = 10;
        $marginTop = 25;
        $marginBottom = 40;
        $pageWidth = $this->GetPageWidth();
        $pageHeight = $this->GetPageHeight();
        
        $rectWidth = $pageWidth - $marginLeft - $marginRight;
        $rectHeight = $pageHeight - $marginTop - $marginBottom;
        $rectX = $marginLeft;
        $rectY = $marginLeft;
        
        $this->Rect($rectX, $marginTop , $rectWidth, $rectHeight);
        
        $this->SetFont( "Arial", "", 8);
        $this->Rect(($rectX+ $rectWidth-($rectWidth*.25)),($marginTop)-12,($rectWidth*.25),12);
        $this->SetXY(($rectX+ $rectWidth-($rectWidth*.25)) , ($marginTop)-12);
        $this->Cell(50,15/2,'Policy No',0,0,'l');
        $this->SetXY(($rectX+ $rectWidth-($rectWidth*.25)) , ($marginTop)-12);
        $this->Cell(50,15,$this->formID,0,0,'C');
        
        // NAME AND ADDRESS OF INSURED
        $this->Rect(($rectX),$marginTop,($rectWidth*.50),48);
        $this->SetFont( "Arial", "B", 10);
        $this->SetXY(($rectX),($marginTop - 5));
        $this->Cell(($rectWidth*.50),36,$this->fullName,0,0,'C');
        $this->SetXY(($rectX),($marginTop + 20));
        $this->MultiCell(($rectWidth*.50),4,$this->address ,0,'C',false);
        
        //BUSINESS PROFESSION
        $this->Rect(($rectX+$rectWidth*.50),$marginTop,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'BUSINESS PROFESSION',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->profession,0,0,'C');
        
        
        // DATE ISSUED
        $this->Rect(($rectX+$rectWidth*.50),$marginTop + 12,($rectWidth*.50),12);
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 12));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'DATE ISSUED',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 12));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->date_issue,0,0,'C');
        
        
        // $this->Rect(($rectX+$rectWidth*.50),$marginTop + 24,($rectWidth*.50),12);
        // $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 24));
        // $this->SetFont( "Arial", "B", 10);
        // $this->Cell(($rectWidth*.50),15,$profession,0,0,'C');
        
        // PERIOD OF ISSUANCE
        $this->Rect(($rectX+$rectWidth*.50),$marginTop + 24,($rectWidth*.50),12);
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 24));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.50),15,'PERIOD OF ISSUANCE',0,0,'C');
        
        // FROM
        $this->Rect(($rectX+$rectWidth*.50),$marginTop + 36,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 36));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'FROM',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.50),($marginTop + 36));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->period_issuance_from,0,0,'C');
        
        //CONFIRMATION OF COVER NO
        $this->Rect(($rectX+$rectWidth*.75),$marginTop,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop ));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'CONFIRMATION OF COVER NO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop ));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->conf_cover,0,0,'C');
        
        
        // OFFICIA RECEIPT NO
        $this->Rect(($rectX+$rectWidth*.75),$marginTop + 12,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 12));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'OFFICIAL RECEIPT NO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 12));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->official_receipt,0,0,'C');
        
        
         
        // to 
        $this->Rect(($rectX+$rectWidth*.75),$marginTop + 36,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 36));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'TO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 36));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->period_issuance_to,0,0,'C');
        
        
        
        // Scheduled Vehicle ]
        $this->Rect(($rectX),$marginTop+48,($rectWidth),12);
        $this->SetFont( "Arial", "B", 10);
        $this->SetXY(($rectX),($marginTop + 48));
        $this->Cell(($rectWidth),12,"SCHEDULED VEHICLE",0,0,'l');
        
        // Model
        $this->Rect(($rectX),$marginTop+60,($rectWidth*.15),12);
        $this->SetXY(($rectX),($marginTop + 60));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'MODEL',0,0,'l');
        $this->SetXY(($rectX),($marginTop + 60));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.15),15,$this->vehicle_model,0,0,'C');
        
        // Make
        $this->Rect(($rectX+$rectWidth*.15),$marginTop+60,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.15),($marginTop + 60));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'MAKE',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.15),($marginTop + 60));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->vehicle_make,0,0,'C');
        
        
        // TYPE OF BODY
        $this->Rect(($rectX+$rectWidth*.40),$marginTop+60,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 60));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'TYPE OF BODY',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 60));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->vehicle_type,0,0,'C');
        
        
        // COLOR 
        $this->Rect(($rectX+$rectWidth*.60),$marginTop+60,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 60));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'COLOR',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 60));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->vehicle_color,0,0,'C');
        
        
        // BLT FILE NO
        $this->Rect(($rectX+$rectWidth*.80),$marginTop+60,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 60));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'BLT FILE NO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 60));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->vehicle_blt,0,0,'C');
        
        
        //PLATE NO.
        $this->Rect(($rectX),$marginTop+72,($rectWidth*.15),12);
        $this->SetXY(($rectX),($marginTop + 72));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'PLATE NO.',0,0,'l');
        $this->SetXY(($rectX),($marginTop + 72));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth*.15),15,$this->vehicle_platenum,0,0,'C');
        
        
        //SERIAL/ChASSIS NO.
        $this->Rect(($rectX+$rectWidth*.15),$marginTop+72,($rectWidth*.25),12);
        $this->SetXY(($rectX+$rectWidth*.15),($marginTop + 72));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'SERIAL/ChASSIS NO.',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.15),($marginTop + 72));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth*.25),15,$this->vehicle_chassis,0,0,'C');
        
        //MOTOR NO.
        $this->Rect(($rectX+$rectWidth*.40),$marginTop+72,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 72));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'MOTOR NO.',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 72));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->vehicle_motornum,0,0,'C');
        
        //AUTHORIZED CAPACITy.
        $this->Rect(($rectX+$rectWidth*.60),$marginTop+72,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 72));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'AUTHORIZED CAPACITy.',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.60),($marginTop + 72));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->capacity,0,0,'C');
        
        //UNLADEN WEIGHT (Kgs).
        $this->Rect(($rectX+$rectWidth*.80),$marginTop+72,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 72));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'UNLADEN WEIGHT (Kgs).',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.80),($marginTop + 72));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth*.20),15,$this->vehicle_weight,0,0,'C');
        
        
        $this->Rect(($rectX),$marginTop+84,($rectWidth),12);
        $this->SetXY(($rectX),($marginTop + 84));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth),12,"SECTION I / II",0,0,'l');
        
        
        $this->Rect(($rectX),$marginTop+96,($rectWidth*.40),24);
        $this->SetXY(($rectX),($marginTop + 96));
        $this->SetFont("Arial", "", 8);
        $this->Cell(($rectWidth*.40),15,'THIRD PARTY LIABILITY',0,0,'C');
        $this->SetXY(($rectX),($marginTop + 106));
        $this->SetFont("Arial", "", 5);
        $this->Multicell(($rectWidth*.40),0,"(SUBJECT TO THE SCHEDULE OF  INDEMNITIES AT THE BACK HEREOF",0,'C');
        
        $this->SetXY(($rectX),($marginTop + 107));
        $this->SetFont("Arial", "", 6);
        $this->Multicell(($rectWidth*.40),2,"(This Confirmation of Cover is evidence of policy of Insurance required under\nChapter VI Compulsory Motor Vehicle Liability Insurance of the Insurance code,as amended by Presidential decree No. 1814",0,'C');
        
        
        $this->Rect(($rectX+$rectWidth*.40),$marginTop+96,($rectWidth*.60),12);
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 96));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,12,'LIMIT OF LIABILITY.',0,0,'l');
        
        $this->SetXY(($rectX+$rectWidth*.40 + 50),($marginTop + 96));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(50,12,'P.',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40 + 55),($marginTop + 96));
        
        $this->Cell(50,12,$this->limitLiability,0,0,'l');
        
        
        $this->Rect(($rectX+$rectWidth*.40),$marginTop+108,($rectWidth*.60),12);
        
        $this->Rect(($rectX+$rectWidth*.40),$marginTop+108,($rectWidth*.60),12);
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 108));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,12,'PREMIUM PAID.',0,0,'l');
        
        $this->SetXY(($rectX+$rectWidth*.40 + 50),($marginTop + 108));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(50,12,'P.',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40 + 55),($marginTop + 108));
        
        $this->Cell(50,12,$this->vehicle_paid,0,0,'l');
        
        
        $this->Rect(($rectX),$marginTop+120,($rectWidth),12);
        $this->SetXY(($rectX),($marginTop + 120));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(($rectWidth),12,"SECTION III",0,0,'l');
        
        
        $this->Rect(($rectX),$marginTop+132,($rectWidth*.70),40);
        $this->SetXY(($rectX),($marginTop + 132));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'RECEIPT ESTIMATE OF VALUE OF SCHEDULE VEHICLE',0,0,'l');
        
        
        $this->SetXY(($rectX),($marginTop + 140));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'ACCESSORIES',0,0,'l');
        
        $this->SetXY(($rectX+5),($marginTop + 147));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'1',0,0,'l');
        
        $this->SetXY(($rectX+5),($marginTop + 152));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'2',0,0,'l');
        
        
        $this->SetXY(($rectX+5),($marginTop + 157));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'3',0,0,'l');
        
        
        $this->SetXY(($rectX+5),($marginTop + 162));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'4',0,0,'l');
          
        $this->SetXY(($rectX+70),($marginTop + 162));
        $this->SetFont( "Arial", "", 8);
        $this->Cell((1),15/2,'_______________       _______________',0,0,'l');
        
        $this->SetXY(($rectX+99),($marginTop + 165));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'_______________',0,0,'l');
        $this->SetXY(($rectX+95),($marginTop + 165));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'P',0,0,'l');
        $this->SetXY(($rectX+95),($marginTop + 162.8));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'_',0,0,'l');
        $this->SetXY(($rectX+95),($marginTop + 163.2));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.70),15/2,'_',0,0,'l');
        
        $this->Rect(($rectX),$marginTop + 172,($rectWidth*.20),12);
        $this->SetXY(($rectX),($marginTop + 172));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'OFFICIAL RECEIPT NO',0,0,'l');
        $this->SetXY(($rectX),($marginTop + 173));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.20),15,'P',0,0,'l');
        $this->SetXY(($rectX),($marginTop + 171));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.20),15,'_',0,0,'l');
        
        
        $this->Rect(($rectX+$rectWidth*.20),$marginTop + 172,($rectWidth*.20),12);
        $this->SetXY(($rectX+$rectWidth*.20),($marginTop + 172));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'OFFICIAL RECEIPT NO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.20),($marginTop + 173));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.20),15,'P',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.20),($marginTop + 171));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.20),15,'_',0,0,'l');
        
        
        $this->Rect(($rectX+$rectWidth*.40),$marginTop + 172,($rectWidth*.30),12);
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 172));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'OFFICIAL RECEIPT NO',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 173));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.60),15,'P',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.40),($marginTop + 171));
        $this->SetFont( "Arial", "B", 8);
        $this->Cell(($rectWidth*.60),15,'_',0,0,'l');
        
        
        $this->Rect(($rectX),$marginTop + 184,($rectWidth*.70),12);
        $this->SetXY(($rectX),($marginTop + 184));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(50,12,'SECTION IV',0,0,'l');
        
        //Body Injury
        $this->Rect(($rectX),$marginTop + 196,($rectWidth*.35),12);
        $this->SetXY(($rectX),($marginTop + 196));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'A. Body Injury',0,0,'l');
        
        //Body Injury
        $this->Rect(($rectX+$rectWidth*.35),$marginTop + 196,($rectWidth*.35),12);
        $this->SetXY(($rectX+$rectWidth*.35),($marginTop + 196));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'B. Property Damage',0,0,'l');
        
        
        //Propery Damage
        $this->Rect(($rectX),$marginTop + 208,($rectWidth*.70),12);
        $this->SetXY(($rectX),($marginTop + 208));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'MORTGAGEE',0,0,'l');
        
        
        $this->Rect(($rectX),$marginTop + 220,($rectWidth),12);
        $this->SetXY(($rectX),($marginTop + 220));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'Forms and Endorsements Made Part of this Policy at time of Issue',0,0,'l');
        $this->SetXY(($rectX+30),($marginTop + 228));
        $this->SetFont( "Arial", "B", 10);
        $this->Cell(50,2,'NOTE FOR TPL ONLY..',0,0,'l');
         
        //TOTAL
        $this->Rect(($rectX+$rectWidth*.70),$marginTop + 208,($rectWidth*.30),12);
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 208));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,15/2,'TOTAL',0,0,'l');
        
        $this->SetXY(($rectX+$rectWidth*.73),($marginTop + 210));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,12,'P',0,0,'l');
        
        
        $this->SetXY(($rectX+$rectWidth*.73),($marginTop + 208.3));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(50,12,'_',0,0,'l');
        
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 210));
        $this->SetFont("Arial", "B", 12);
        $this->Cell($rectWidth*.30,12,$this->vehicle_totalpaid,0,0,'C');
        
        
        $this->SetXY(($rectX),($marginTop + 234));
        $this->SetFont("Arial", "", 10);
        $this->Multicell(($rectWidth),4.5,"IN WITNESS WHEREOF, the Company has caused this policy to be signed by its duly authorized office/representative at ___________________. Philippines, this ____________ day of ____________",0,'l');
        $this->SetXY(($rectX+$rectWidth*.35),($marginTop + 235));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(20,12,$this->dateDay,0,0,'C');
        
        $this->SetXY(($rectX+$rectWidth*.55),($marginTop + 235));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(20,12,$this->dateYear,0,0,'C');
        
        $this->SetXY(($rectX+12),($marginTop + 235));
        $this->SetFont("Arial", "B", 10);
        $this->Cell(20,12,"Panabo City, DDN.",0,0,'C');
              
        //PREMIUM  
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 132));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.30),15/2,'PREMIUM',1,0,'C');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 143));
        $this->SetFont( "Arial", "", 8);
        $this->Cell(($rectWidth*.30),15/2,'P',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 140.3));
        $this->SetFont( "Arial", "", 10);
        $this->Cell(($rectWidth*.30),15/2,'_',0,0,'l');
        $this->SetXY(($rectX+$rectWidth*.75),($marginTop + 141));
        $this->SetFont( "Arial", "", 10);
        $this->Cell(($rectWidth*.30),15/2,'_',0,0,'l');
        
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 145));
        $this->SetFont("Arial", "B", 12);
        $this->Cell(($rectWidth*.30),15,$this->vehicle_premium,0,0,'C');
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 160));
        $this->SetFont("Arial", "B", 12);
        $this->Cell(($rectWidth*.30),15,$this->vehicle_docstamp,0,0,'C');
        
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 175));
        $this->SetFont("Arial", "B", 12);
        $this->Cell(($rectWidth*.30),15,$this->vehicle_govtax,0,0,'C');
        $this->SetXY(($rectX+$rectWidth*.70),($marginTop + 190));
        $this->SetFont("Arial", "B", 12);
        $this->Cell(($rectWidth*.30),15,$this->vehicle_others,0,0,'C');
    }
}