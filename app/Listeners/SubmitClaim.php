<?php

namespace App\Listeners;

use App\Events\ClaimInsurance;
use App\Models\User;
use App\Notifications\SendClaimInsurancecNotification;

class SubmitClaim
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClaimInsurance $event): void
    {
        $requestor = $event->transaction->user->customer[0]->full_name;
        $type = $event->transaction->policy->type;


        $users = User::whereIn('role',[1,2])->get();
        foreach($users as $user){
            $user->notify(new SendClaimInsurancecNotification($requestor,$type));
        }
   //
    }
}
