<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController
{
 
    public function create()
    {
        return view('auth.register');
    }

    // public function store()
    // {

    //     $validate = request()->validate([
    //         'username'=> ['required'],
    //         'email'=> ['required']
    //         'password'=> ['required']
    //         'username'=> ['required']
    //         'username'=> ['required']
    //         'username'=> ['required']

    //     ]));

    //     User::create(
    // }
    
}
