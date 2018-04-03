<?php
/**
 * Created by PhpStorm.
 * User: dragantic91
 * Date: 11/25/2017
 * Time: 12:20 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorised.', 401);
            }
            else {
                return redirect()->route('admin.login');
            }
        }

        $user = Auth::user();
        if (isset($user->language) && !empty($user->language)) {
            App::setLocale($user->language);
        }

        return $next($request);
    }
}