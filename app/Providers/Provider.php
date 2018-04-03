<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    protected function registerMiddleware()
    {
        $router = $this->app['router'];

        $router->aliasMiddleware('admin.guest', RedirectIfAdminAuth::class);
    }
}