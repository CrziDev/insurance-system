<?php

namespace App\Http\Controllers\Customer;

use App\Models\NonLifeInsurance;

class CustomerInsuranceController
{
    public function index(){
        $nonLifeInsurance = NonLifeInsurance::where('user_id',request()->user()->id)->get();

        return view('pages.customer.insurance',[
            "nonLifeInsurance" => $nonLifeInsurance
        ]);
    }
}
