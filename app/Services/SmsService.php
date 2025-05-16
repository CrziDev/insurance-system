<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    public function send(string $number, string $message): array
    {
        $response = Http::asForm()->post(env('SEMPHORE_URL'), [
            'apikey' => env('SEMAPHOR_ACCESS_KEY'),
            'number' => $number,
            'message' => $message,
            'sendername' => env('SEMPHORE_SENDERNAME'),
        ]);

        return $response->json();
    }

    public function approvedInsurance($customerName,$policy,$number){

        $message = "
            Dear " .$customerName. ", 
            your insurance claim " .$policy. " 
            has been approved. You may now proceed to 
            the next steps as advised by our team. 
            Thank you for trusting ZILKA Life Insurance Services.
        ";

        $this->send($number,$message);
    }

        public function renewedInsurance($customerName,$policy,$number){

        $message = "
            Hello [Customer Name], your insurance policy
            #[PolicyNumber] has been successfully renewed. 
            Your updated policy is now active. Thank you for 
            continuing with ZILKA Life Insurance Services.
        ";

        $this->send($number,$message);
    }
}
