<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactEmail;
use App\Models\Database\Page;
use App\Models\Database\PageUberUns;
use App\Models\Database\PageWirKaufen;
use App\Models\Database\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display the specified page.
     */
    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();

        return view('front.page.show')
            ->with('page', $page);
    }

    public function about()
    {
        $text = PageUberUns::where('key', '=', 'text')->first();

        $banners = PageUberUns::where('key', '=', 'image')->get();

        $page = Page::where('slug', '=', 'about-us')->first();

        return view('front.page.about')
            ->with([
                'page' => $page,
                'text' => $text,
                'banners' => $banners
            ]);
    }

    public function wirKaufen() {

        $description = PageWirKaufen::all()->first();

        $page = Page::where('slug', '=', 'wir')->first();

        return view('front.page.wirKaufen', compact('page', 'description'));
    }

    public function sendWirEmail(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'mess' => 'required',
            'image' => 'required'
        ]);

        $data = $request->all();

        $images = $request->image;

        $image_number = count($images);
        if ($image_number > 5){
            return redirect()->back()->with('notificationError', __('front.image1-5'));
        }
        for ($i = 0; $i < $image_number; $i++){
            $this->validate($request, [
                'image.' . $i => 'mimes:jpeg,jpg,png|max:2048'
            ]);
        }

        $names = [];
        foreach ($images as $image){
            $names[] = time() . $image->getClientOriginalName();
            $name = time() . $image->getClientOriginalName();
            Storage::putFileAs(
                'email', $image, $name
            );
        }

        $contactForm = ([
            'name' => $data['name'],
            'phone' => $data['tel'],
            'email' => $data['email'],
            'message' => $data['mess'],
            'image' => $names,
        ]);

        $page = Page::where('slug', '=', 'wir')->first();

        dispatch(new SendContactEmail($contactForm));

        foreach ($names as $name){
            Storage::delete('/email/' . $name);
        }

        return redirect()->route('wir-kaufen')
            ->with('page', $page)
            ->with('notificationText', __('front.email-success-sent'));
    }

    public function contact()
    {
        $page = Page::where('slug', '=', 'contact')->first();

        return view('front.page.contact')
            ->with('page', $page);
    }

    public function sendContactEmail(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'tel' => 'required',
            'email' => 'required',
            'mess' => 'required',
        ]);

        $data = $request->all();
        $contactForm = ([
            'name' => $data['name'],
            'phone' => $data['tel'],
            'email' => $data['email'],
            'message' => $data['mess'],
        ]);

        $page = Page::where('slug', '=', 'contact')->first();

        dispatch(new SendContactEmail($contactForm));
        return redirect()->route('contact')
            ->with('page', $page)
            ->with('notificationText', __('front.email-success-sent'));
    }

    public function subscribe(Request $request){

        $this->validate($request, [
           'email' => 'required|unique:subscribers,email',
        ]);

        Subscriber::create($request->all());
        return redirect()->back()
            ->with('notificationText', __('front.subscribe-success-sent'));
    }
}