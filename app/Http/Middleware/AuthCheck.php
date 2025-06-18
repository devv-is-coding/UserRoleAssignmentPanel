<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class AuthCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('LoggedAdmin')) {
            return redirect()->route('auth.login')->with('fail', 'You must be logged in.');
        }
        return $next($request);
    }
}
