<?php

namespace App\Http\Controllers\Customer;

use App\Models\NonLifeInsurance;

class CustomerClaimsController
{
    public function index(){


        $nonLifeInsurance = NonLifeInsurance::where('user_id',request()->user()->id)->get();

        return view('pages.customer.claims', [
            "nonLifeInsurance" => $nonLifeInsurance
        ]);
    }
}
