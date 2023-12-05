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

        // Prevent caching of pages
        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}