<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Database\Popup;
use App\Models\Database\Package;
use App\DataGrid\Facade as DataGrid;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PopupController extends Controller
{
    public function index()
    {
        $dataGrid = DataGrid::model(Popup::query())
            ->column('title', ['sortable' => true, 'label' => __('lang.title')])
            ->linkColumn(__('lang.edit'), [], function ($model) {
                return "<a href='" . route('admin.popup.edit', $model->id) . "' >".__('lang.edit')."</a>";
            })
            ->linkColumn(__('lang.delete'), [], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->name}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);

        return view('admin.popup.index')->with('dataGrid', $dataGrid);
    }


    public function create()
    {
        $packages = Package::all();

        return view('admin.popup.create')
            ->with('packages', $packages);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'package_id' => 'required',
            'title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
            'active' => 'required',
            'end_date' => 'required'
        ]);

        $image = $request->image;
        $name = time() . $image->getClientOriginalName();
        $folder = '/uploads/popup/';
        $savePath = public_path($folder);
        Image::make($image->getRealPath())->resize(1140, 480)->save($savePath . $name);
        $dbPath = $folder . $name;

        if ($request->active == true) {
            $allPopups = Popup::where('active', 1);
            $allPopups->update(['active' => 0]);
        }

        Popup::create([
            'package_id' => $request->package_id,
            'title' => $request->title,
            'image' => $dbPath,
            'active' => $request->active,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.popup.index');
    }


    public function edit($id)
    {
        $packages = Package::all();
        $popup = Popup::findOrFail($id);

        return view('admin.popup.edit')
            ->with('popup', $popup)
            ->with('packages', $packages);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'package_id' => 'required',
            'title' => 'required',
            'end_date' => 'required'
        ]);

        $popup = Popup::findorfail($id);

        if ($request->active == true) {
            $allPopups = Popup::where('active', 1);
            $allPopups->update(['active' => 0]);
        }

        $popup->update($request->all());

        return redirect()->route('admin.popup.index');
    }


    public function destroy($id)
    {
        $popup = Popup::findorfail($id);
        File::delete(public_path($popup->image));
        $popup->delete();
        return redirect()->back();
    }
}
