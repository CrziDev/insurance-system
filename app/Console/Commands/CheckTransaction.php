<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $transactions = Transaction::whereIn('status', [1,2,3])->get();

            foreach ($transactions as $transaction) {
                // Get the expiration date of the transaction
                $expirationDate = Carbon::parse($transaction->expiration);
                
                // Get the current date
                $currentDate = Carbon::now();
                
               // Check if the current date has passed the expiration date
                if ($currentDate->isAfter($expirationDate)) {
                    // If the current date has passed the expiration, change status to 2
                    $transaction->status = 2;
                } 
                // Check if the current date is 3 months before the expiration date
                elseif ($currentDate->isAfter($expirationDate->copy()->subMonths(3))) {
                    // If it's 3 months before expiration, change status to 3
                    $transaction->status = 3;
                }
                
                // Save the transaction after changing the status
                $transaction->save();
            }
    }
}
