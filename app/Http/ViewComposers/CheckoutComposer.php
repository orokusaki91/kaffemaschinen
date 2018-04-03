<?php

namespace App\Http\ViewComposers;

use App\Models\Database\Configuration;
use App\Models\Database\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CheckoutComposer
{
    public function compose(View $view)
    {
        $termConditionPageUrl = '#';

        $user = Auth::user();

        $pageId = Configuration::getConfiguration('general_term_condition_page');

        if (null !== $pageId) {
            $page = Page::find($pageId);
            $termConditionPageUrl = "/page/" . $page->slug;
        }

        $cartProducts = Session::get('cart');
        $view->with('cartProducts', $cartProducts)
            ->with('user', $user)
            ->with('termConditionPageUrl', $termConditionPageUrl);
    }
}