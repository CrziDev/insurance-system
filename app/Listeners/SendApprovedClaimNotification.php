<?php

namespace App\Listeners;

use App\Events\ApprovedClaim;
use App\Models\User;
use App\Notifications\SendApproveClaimInsurancecNotification;

class SendApprovedClaimNotification
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
    public function handle(ApprovedClaim $event): void
    {
        $requestor = $event->transaction->user->customer[0]->full_name;
        $type = $event->transaction->policy->type;

        $event->user->notify(new SendApproveClaimInsurancecNotification($requestor,$type));
        
    }
}
