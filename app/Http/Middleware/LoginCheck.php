<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 1) { // Assuming role 1 is the required role
                return $next($request);
            }
            else{
                return Redirect::route('login')->withInput()->with('error', 'You need to permission for access.');
            }
           
        }

        // If the user is not logged in, redirect them to the login route with an error message.
        return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
    }
    
}
