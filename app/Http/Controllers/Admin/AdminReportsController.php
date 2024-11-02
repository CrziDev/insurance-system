<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;

class AdminReportsController
{
    public function index(){

        return view('pages.admin.reports');
    }
}
