<?php

namespace App\Http\Controllers\Admin;

use App\Models\Database\PageUberUns;
use App\Models\Database\PageWirKaufen;
use Illuminate\Http\Request;
use App\DataGrid\Facade as DataGrid;
use App\Models\Database\PageHome;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PageController extends Base
{

    public function home()
    {
        $dataGrid = DataGrid::model(PageHome::query())
            ->column('heading', ['sortable' => true, 'label' => __('lang.heading')])
            ->linkColumn(__('lang.edit'), [], function ($model) {
                return "<a href='" . route('admin.home.edit', $model->id) . "' >".__('lang.edit')."</a>";
            })
            ->linkColumn('destroy', ['label' => __('lang.destroy')], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->heading}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);

        return view('admin.page.home.index')->with('dataGrid', $dataGrid);
    }


    public function homeCreate()
    {
        return view('admin.page.home.create');
    }


    public function homeStore(Request $request)
    {
        $this->validate($request, [
            'heading' => 'required',
            'body' => 'required',
            'button' => 'required',
            'url' => 'required|url',
            'color' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = $request->image;
        $name = time() . $image->getClientOriginalName();
        $folder = '/front/assets/img/slider/';
        $savePath = public_path($folder);
        Image::make($image->getRealPath())->resize(1140, 480)->save($savePath . $name);
        $dbPath = $folder . $name;


        PageHome::create([
            'heading' => strtoupper($request->heading),
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'color' => $request->color,
            'image' => $dbPath
        ]);

        return redirect()->route('admin.page.home');
    }


    public function homeEdit($id)
    {
        $banner = PageHome::findOrFail($id);
        return view('admin.page.home.edit')
            ->with('banner', $banner);
    }


    public function homeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'heading' => 'required',
            'button' => 'required',
            'body' => 'required',
            'url' => 'required|url',
            'color' => 'required',
        ]);

        $banner = PageHome::findorfail($id);
        $banner->heading = $request->heading;
        $banner->button = $request->button;
        $banner->body = $request->body;
        $banner->url = $request->url;
        $banner->color = $request->color;
        $banner->update();

        return redirect()->route('admin.page.home');

    }


    public function homeDestroy($id)
    {
        $slider = PageHome::findorfail($id);
        File::delete(public_path($slider->image));
        $slider->delete();
        return redirect()->route('admin.page.home');
    }


    public function uberUns()
    {
        $dataGrid = DataGrid::model(PageUberUns::query()->where('key', '=', 'image'))
            ->column('banner_name', ['sortable' => true, 'label' => __('lang.banner-name')])
            ->linkColumn('destroy', ['label' => __('lang.destroy')], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->banner_name}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);

        $text = PageUberUns::where('key', '=', 'text')->first();

        return view('admin.page.uberUns.index')
            ->with(['text' => $text, 'dataGrid' => $dataGrid]);
    }


    public function textUpdateUberUns(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $text = PageUberUns::findorfail($id);
        $text->value = $request->body;
        $text->update();

        return redirect()->back()
            ->with(['success' => __('lang.update-success')]);
    }


    public function bannerUberUnsCreate()
    {
        return view('admin.page.uberUns.create');
    }


    public function bannerUberUnsStore(Request $request)
    {
        $this->validate($request, [
            'banner_name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = $request->image;
        $name = time() . $image->getClientOriginalName();
        $folder = '/front/assets/img/about/';
        $savePath = public_path($folder);
        Image::make($image->getRealPath())->resize(1140, 480)->save($savePath . $name);
        $dbPath = $folder . $name;

        PageUberUns::create([
            'banner_name' => $request->banner_name,
            'key' => 'image',
            'value' => $dbPath
        ]);

        return redirect()->route('admin.page.uber-uns');
    }


    public function bannerUberUnsDestroy($id)
    {
        $banner = PageUberUns::findorfail($id);
        File::delete(public_path($banner->value));
        $banner->delete();

        return redirect()->route('admin.page.uber-uns');
    }


    public function wirKaufen()
    {
        $description = PageWirKaufen::all()->first();

        return view('admin.page.wirKaufen.index')
            ->with('description', $description);
    }


    public function updateWirKaufen(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $description = PageWirKaufen::findorfail($id);
        $description->body = $request->body;
        $description->update();

        return redirect()->back()->with(['success' => __('lang.update-success')]);
    }
}
