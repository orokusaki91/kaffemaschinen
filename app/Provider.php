<?php

namespace App;

use App\Http\Middleware\Visitor;
use App\Http\ViewComposers\CategoryFieldsComposer;
use App\Http\ViewComposers\CheckoutComposer;
use App\Http\ViewComposers\LayoutAppComposer;
use App\Http\ViewComposers\ProductFieldsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Http\ViewComposers\AdminNavComposer;

class Provider extends ServiceProvider
{
    protected $providers = [

    ];

    public function boot()
    {
        $this->registerMiddleware();
        $this->registerViewComposerData();
    }

    /**
     * Registering Centrocaffe E-commerce Middleware
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('visitor', Visitor::class);
    }

    /**
     * Registering Class Based View Composer
     *
     * @return void
     */
    public function registerViewComposerData()
    {
        View::composer('admin.layouts.left-nav', AdminNavComposer::class);
        View::composer(['admin.category._fields'], CategoryFieldsComposer::class);
        View::composer(['front.layouts.app', 'front.catalog.category.options'], LayoutAppComposer::class);
        View::composer(['admin.product.create', 'admin.product.edit'], ProductFieldsComposer::class);
        View::composer(['front.checkout.index'], CheckoutComposer::class);
    }
}