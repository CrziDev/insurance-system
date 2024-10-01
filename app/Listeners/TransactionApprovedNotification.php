<?php

namespace App\Listeners;

use App\Events\InsuranceApproved;
use App\Notifications\TransactionApproveNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransactionApprovedNotification
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
    public function handle(InsuranceApproved $event): void
    {
        $requestor = $event->transaction->user->customer[0]->full_name;
        $type = $event->transaction->policy->type;

        $user = $event->user;
        $user->notify(new TransactionApproveNotification($requestor,$type));
    }
}
