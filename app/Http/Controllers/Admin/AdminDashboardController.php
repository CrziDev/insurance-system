<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminDashboardController
{
    public function index(){

        return view('pages.admin.dashboard');
    }
}
