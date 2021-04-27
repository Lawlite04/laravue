<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->level == "admin"){
            return $next($request);
        }elseif (Auth::user()->level == "petugas") {
            return $next($request);
        }elseif (Auth::user()->level == "user") {
            return $next($request);
        }

        return redirect('/login')->with('error','Login Error');
    }
}
