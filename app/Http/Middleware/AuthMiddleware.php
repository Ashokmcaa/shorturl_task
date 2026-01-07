<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // ❌ User not logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['auth' => 'Please login to continue']);
        }

        return $next($request);
    }
}
