<?php

namespace App\Http\Controllers\Customer;

use App\Models\non_life_type;
use App\Models\NonLifeInsurance;
use Illuminate\Http\Request;

class CustomerDashboardontroller
{
    public function index(){
        $nonLifeInsurance = NonLifeInsurance::where('user_id',request()->user()->id)->get();

        return view('pages.customer.dashboard', [
            "nonLifeInsurance" => $nonLifeInsurance
        ]);
    }
}
