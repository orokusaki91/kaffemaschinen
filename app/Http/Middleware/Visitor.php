<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Database\Visitor as VisitorModel;

class Visitor
{
    public function handle($request, Closure $next)
    {
        if (Schema::hasTable('visitors')) {
            $url = $request->path();
            $ipAddress = $request->getClientIp();
            $userId = NULL;
            $agent = $request->server('HTTP_USER_AGENT');

            if (Auth::check()) {
                $userId = Auth::user()->id;
            }

            VisitorModel::create([
                'url' => $url,
                'ip_address' => $ipAddress,
                'user_id' => $userId,
                'agent' => $agent
            ]);
        }

        return $next($request);
    }
}