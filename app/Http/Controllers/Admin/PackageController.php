<?php

namespace App\Http\Controllers\Admin;

use App\Models\Database\Package;
use App\Models\Database\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataGrid\Facade as DataGrid;

class PackageController extends Controller
{
    public function index()
    {
        $dataGrid = DataGrid::model(Package::query())
            ->setDefaultOrder(['field' => 'created_at', 'keyword' => 'desc'])
            ->column('name', ['sortable' => true, 'label' => __('lang.name')])
            ->column('created_at', ['sortable' => true, 'label' => __('lang.created-at')])
            ->linkColumn(__('lang.edit'), [], function ($model) {
                return "<a href='" . route('admin.package.edit', $model->id) . "' >".__('lang.edit')."</a>";
            })
            ->linkColumn(__('lang.delete'), [], function ($model) {
                return "<form id='admin-package-destroy-" . $model->id . "'
                                            method='POST'
                                            action='" . route('admin.package.destroy', $model->id) . "'>
                                        <input name='_method' type='hidden' value='DELETE' />
                                        " . csrf_field() . "
                                        <a href='#'
                                            onclick=\"jQuery('#admin-package-destroy-$model->id').submit()\"
                                            >". __('lang.delete') ."</a>
                                    </form>";
            })
            ->setPagination(100);

        return view('admin.package.index')
            ->with('dataGrid', $dataGrid);
    }

    public function create()
    {
        return view('admin.package.new-create');
    }

    public function store(Request $request)
    {
        try {
            $package = Package::create($request->all());
            $package->products()->sync($request->input('products'));
        } catch (\Exception $e) {
            echo 'Error in Saving Package: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.package.index');
    }

    public function edit($id)
    {
        $package = Package::findorfail($id);

        return view('admin.package.edit')
            ->with('model', $package);
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->update($request->all());
        $package->products()->sync($request->input('products'));

        return redirect()->route('admin.package.index');
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();

        return redirect()->route('admin.package.index');
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")->orWhere('slug', 'LIKE', "%{$query}%")->get();

        return $products;
    }

    public function getSingleProduct(Request $request)
    {
        $id = $request->input('id');

        $product = Product::find($id);

        return $product;
    }
}
