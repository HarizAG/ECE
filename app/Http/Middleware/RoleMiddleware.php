<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        //dd(Auth::user());
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403); // Unauthorized
        }

        // if (!Auth::check() || Auth::user()->role !== $role) {
        //   return redirect('/welcome'); // Redirect if the role doesn't match
        //}

        return $next($request);
    }
}
