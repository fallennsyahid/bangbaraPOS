<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureCartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::isStarted()) {
            Session::start(); // Memulai sesi jika belum dimulai
        }

        // Pastikan session_id ada untuk user tanpa akun
        if (!Session::has('session_id')) {
            Session::put('session_id', session()->getId());
        }

        return $next($request);
    }
}
