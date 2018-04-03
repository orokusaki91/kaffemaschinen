<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class FrontAuth
{
    public function handle($request, Closure $next, $guard = "web")
    {
        if (Auth::guard($guard)->guest()){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            else {
                return redirect()->guest('/login');
            }
        }

        return $next($request);
    }
}