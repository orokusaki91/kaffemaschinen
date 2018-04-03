<?php

namespace App\Http\ViewComposers;

use App\Models\Database\Category;
use App\Models\Database\Configuration;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LayoutAppComposer
{
    public function compose(View $view)
    {
        $cart = count(Session::get('cart'));
        $categoryModel = new Category();
        $baseCategories = $categoryModel->getAllCategories();

        $metaTitle = Configuration::getConfiguration('general_site_title');
        $metaDescription = Configuration::getConfiguration('general_site_description');

        $view->with('categories', $baseCategories)
            ->with('cart', $cart)
            ->with('metaTitle', $metaTitle)
            ->with('metaDescription', $metaDescription);
    }
}