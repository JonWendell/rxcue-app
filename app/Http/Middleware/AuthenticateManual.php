<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateManual
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the 'user' session is set
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'You must log in first.');
        }

        return $next($request);
    }
}