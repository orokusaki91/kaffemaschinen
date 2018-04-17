<?php

namespace App\Providers;

use Stripe\Stripe;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Database\Category;
use App\Models\Database\Popup;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('local')) {
            Stripe::setApiKey(config('development.stripe.secret_key'));
        } elseif (app()->environment('production')) {
            Stripe::setApiKey(config('stripe.secret_key'));
        }
        
        Schema::defaultStringLength(191);
        
        $popup = Popup::where('active', 1)->first();
        View::share('popup', $popup);

        $navs = Category::where('parent_id', null)->get();
        View::share('navs', $navs);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
