<?php

namespace App\Listeners;

use App\Events\InsuranceCreated;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewNotification;
use App\Notifications\TransactionCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTransactionNotification
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
    public function handle(InsuranceCreated $event): void
    {
        $requestor = $event->transaction->user->customer[0]->full_name;
        $type = $event->transaction->policy->type;


        $users = User::whereIn('role',[1,2])->get();
        foreach($users as $user){
            $user->notify(new TransactionCreatedNotification($requestor,$type));
        }
    }
}
