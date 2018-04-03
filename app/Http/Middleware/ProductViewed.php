<?php

namespace App\Http\Middleware;

use App\Models\Database\Product;
use App\Models\Database\UserViewedProduct;
use Closure;
use Illuminate\Support\Facades\Auth;

class ProductViewed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        if ('product.view' == $route->getName()) {
            if (Auth::check()) {
                $userId = Auth::user()->id;
                $slug = $route->parameter('slug');
                $product = Product::whereSlug($slug)->first();

                UserViewedProduct::create(['user_id' => $userId, 'product_id' => $product->id]);
            }
        }

        return $next($request);
    }
}
