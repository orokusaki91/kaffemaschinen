<?php

namespace App\Http\ViewComposers;

use App\Models\Database\Category;
use Illuminate\View\View;

class CategoryFieldsComposer
{
    public function compose(View $view)
    {
        $categoryOptions = Category::getCategoryOptions('name', 'id');
        $view->with('categoryOptions', $categoryOptions);
    }
}