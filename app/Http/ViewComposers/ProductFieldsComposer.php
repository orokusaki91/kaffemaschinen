<?php

namespace App\Http\ViewComposers;

use App\Models\Database\Category;
use Illuminate\View\View;

class ProductFieldsComposer
{
    public function compose(View $view)
    {
        $categoryOptions = Category::pluck('name', 'id');
        $storageOptions = []; //Storage::pluck('name', 'id');
        $view->with('categoryOptions', $categoryOptions)
            ->with('storageOptions',$storageOptions);
    }
}