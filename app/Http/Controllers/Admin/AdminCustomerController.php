<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;

class AdminCustomerController
{
    public function index(){
        return view('pages.admin.customers');
    }
}
