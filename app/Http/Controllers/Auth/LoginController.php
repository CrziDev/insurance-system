<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController
{

    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {   

        $attributes = request()->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'error' => 'Invalid credentials'
            ]);
        }

        
        switch (request()->user()->role) {
            case 1:
                    $url = 'admin/dashboard';
              break;
            case 2:
                    $url = 'staff/dashboard';
              break;
            case 3:
                    $url = 'customer/dashboard';
              break;
            default:  

          }

        return redirect($url);  
    }


    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }
}
