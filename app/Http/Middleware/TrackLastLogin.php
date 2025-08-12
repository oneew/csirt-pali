<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLastLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && !session('login_tracked')) {
            auth()->user()->updateLastLogin($request->ip());
            session(['login_tracked' => true]);
        }

        return $next($request);
    }
}