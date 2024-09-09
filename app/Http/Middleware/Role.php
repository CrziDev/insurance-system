<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): Response
    {
        $roles = [
            'admin' => [1],
            'staff' => [2],
            'customer' => [3],
        ];

        if(!in_array(request()->user()->role,$roles[$role])){
            abort(403);
        }

        return $next($request);
    }
}
