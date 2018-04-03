<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Page extends BaseModel
{
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description'];

    /**
     * Display the specified page.
     */
    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();

        return view('page.show')->with('page', $page);
    }
}
