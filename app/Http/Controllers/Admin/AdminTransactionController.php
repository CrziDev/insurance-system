<?php

namespace App\Http\Controllers\Admin;;

use App\Models\NonLifeInsurance;

class AdminTransactionController
{
    public function index(){
        return view('pages.admin.transactions');
    }
}
