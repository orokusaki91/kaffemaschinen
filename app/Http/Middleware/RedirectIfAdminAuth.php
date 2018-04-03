<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfAdminAuth
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {

            return redirect()->route('admin.product.index');
        }

        return $next($request);
    }
}