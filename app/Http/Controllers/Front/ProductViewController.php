<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Database\Page;
use App\Models\Database\Product;
use App\Jobs\SendContactEmail;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['product.viewed']);
    }

    public function view($slug)
    {

        $product = $this->_getProductBySlug($slug);

        $images = $product->getImages();

        $view = view('front.catalog.product.view')
            ->with('metaTitle', 'test')
            ->with('product', $product)
            ->with('images', $images);

        $title = $product->page_title;
        $description = $product->page_description;

        if ($title != '') {
            $view->with('title', $title);
        }
        if ($description != '') {
            $view->with('description', $description);
        }

        return $view;
    }

    private function _getProductBySlug($slug)
    {
        $product = Product::where('slug', '=', $slug)->get()->first();

        return $product;
    }

    public function sendMail(Request $request)
    {
        $data = $request->all();
        $contactForm = ([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['mess'],
            'link' => $data['url'],
        ]);

        dispatch(new SendContactEmail($contactForm));
        return redirect()->back()
            ->with('notificationText', __('front.email-success-sent'));
    }
}