<?php

namespace App\DataGrid;


use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    protected $defer = true;

    public function register() {
        $this->registerDataGrid();
        $this->app->alias('datagrid', 'App\DataGrid\Manager');
    }

    protected function registerDataGrid() {
        $this->app->singleton('datagrid', function ($app){
            $request = $app->request;
            return new Manager($request);
        });
    }

    public function provides()
    {
        return ['datagrid', 'App\DataGrid\Manager'];
    }
}