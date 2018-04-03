<?php

namespace App\Tabs;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Tabs\TabsMaker';
    }
}