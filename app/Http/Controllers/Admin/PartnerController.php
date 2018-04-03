<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Database\Partner;
use App\DataGrid\Facade as DataGrid;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{
    public function index()
    {
        $dataGrid = DataGrid::model(Partner::query())
            ->column('name', ['sortable' => true, 'label' => __('lang.company-name')])
            ->linkColumn(__('lang.edit'), [], function ($model) {
                return "<a href='" . route('admin.partner.edit', $model->id) . "' >".__('lang.edit')."</a>";
            })
            ->linkColumn(__('lang.delete'), [], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->name}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);

        return view('admin.partner.index')->with('dataGrid', $dataGrid);
    }


    public function create()
    {
        return view('admin.partner.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
            'description' => 'required',
            'website' => 'required|url'
        ]);

        $image = $request->image;
        $name = time() . $image->getClientOriginalName();
        $folder = '/uploads/partner/';
        $savePath = public_path($folder);
        Image::make($image->getRealPath())->save($savePath . $name);
        $dbPath = $folder . $name;

        Partner::create([
            'name' => $request->name,
            'image' => $dbPath,
            'description' => $request->description,
            'website' => $request->website,
        ]);

        return redirect()->route('admin.partner.index');
    }


    public function edit($id)
    {
        $partner = Partner::findOrFail($id);

        return view('admin.partner.edit')
            ->with('model', $partner);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'website' => 'required|url'
        ]);

        $partner = Partner::findorfail($id);
        $partner->update($request->all());

        return redirect()->route('admin.partner.index');
    }


    public function destroy($id)
    {
        $partner = Partner::findorfail($id);
        File::delete(public_path($partner->image));
        $partner->delete();
        return redirect()->back();
    }
}
