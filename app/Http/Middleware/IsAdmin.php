<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {
            $user = Auth::user()->is_admin;
            if($user== $role) {
                return $next($request);
            }
        }

        if (Auth::user()->is_admin == 'manager') {
            return redirect('/manager');
        } else if(Auth::user()->is_admin == 'staf') {
            return redirect('/staf');
        } else if(Auth::user()->is_admin == 'user') {
            return redirect('/user');
        } else {
            return redirect('/');
        }
    }
}
