<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminExpiringController
{
    public function index(){
        return view('pages.admin.expiring');
    }
}
