<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Database\Configuration;
use App\Models\Database\Page;
use App\Models\Database\PageHome;
use App\Models\Database\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $pageModel = null;
        $pageId = Configuration::getConfiguration('general_home_page');

        $view = request('view') ? request('view') : 12;
        $mode = request('mode') == 'list' ? 'list' : 'grid';
        $orderBy = $request->order_by ? $request->order_by : null;

        $hitAndNewProducts = Product::where([
                                    ['status', 1],
                                    ['new_product', 1,]
                                ])->orWhere([
                                    ['status', 1],
                                    ['hit_product', 1]
                                ]);
        $hitAndNewProducts = isset($orderBy) ? $hitAndNewProducts->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $hitAndNewProducts;
        $hitAndNewProducts = $hitAndNewProducts->paginate($view);

        $sliders = PageHome::all();

        if(null !== $pageId) {
            $pageModel = Page::find($pageId);
        }

        return view('front.home.index')
            ->with('pageModel', $pageModel)
            ->with('hitAndNewProducts', $hitAndNewProducts)
            ->with('mode', $mode)
            ->with('sliders', $sliders);

    }

    public function getAGB()
    {
        return view('front.page.agb');
    }

    public function getImpressum()
    {
        return view('front.page.impressum');
    }
}