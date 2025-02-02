<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must login first');
        }

        if (Auth::user()->usertype !== 'staff') // Cek user sudah login
        {
            return redirect('/error')->with('error', 'Accsess Denied');
        }
        return $next($request);
    }

}
