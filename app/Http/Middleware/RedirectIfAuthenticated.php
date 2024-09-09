<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check()){
            switch (request()->user()->role) {
                case 1:
                        $url = '/admin/dashboard';
                    break;
                case 2:
                        $url = '/staff/dashboard';
                    break;
                case 3:
                        $url = '/customer/dashboard';
                    break;
                default: 
                }
            return redirect($url);
        }
        return $next($request);
    }
}
