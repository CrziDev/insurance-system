<?php

namespace App\Http\Controllers\Customer;

use App\Models\RenewedHistory;
use Illuminate\Http\Request;

class CustomerRenewedController
{
    public function index(){
    

        return view('pages.customer.history');
    }
}
