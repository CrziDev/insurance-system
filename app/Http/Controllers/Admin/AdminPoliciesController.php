<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminPoliciesController
{
   
    public function index(){

        return view('pages.admin.policies');
    }
}
