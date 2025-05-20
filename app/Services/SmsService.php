<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SmsService
{
    public function send(string $number, string $message):void
    {
          try {
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_number = getenv("TWILIO_NUMBER");
        
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($number, 
                    ['from' => $twilio_number, 'body' => $message]);
        
            } catch (\Exception $e) {
                Log::error("Error sending SMS: " . $e->getMessage());
            }
        // $response = Http::asForm()->post(env('SEMPHORE_URL'), [
        //     'apikey' => env('SEMAPHOR_ACCESS_KEY'),
        //     'number' => $number,
        //     'message' => $message,
        //     'sendername' => env('SEMPHORE_SENDERNAME'),
        // ]);

        // return $response->json();
    }

    public function approvedInsurance($customerName,$policy,$number){

        $message = "Dear {$customerName}, your insurance claim #{$policy} has been approved. You may now proceed to the next steps as advised by our team. Thank you for trusting ZILKA Life Insurance Services.";


        $this->send($number,$message);
    }

        public function renewedInsurance($customerName,$policy,$number){

        $message = "Hello {$customerName}, your insurance policy #{$policy} has been successfully renewed. Your updated policy is now active. Thank you for continuing with ZILKA Life Insurance Services.";


        $this->send($number,$message);
    }
}
