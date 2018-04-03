<?php

namespace App\Http\Controllers\Admin;

use App\Events\ProductAfterSave;
use App\Events\ProductBeforeSave;
use App\Http\Requests\ProductRequest;
use App\Image\LocalFile;
use App\Models\Database\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataGrid\Facade as DataGrid;
use Illuminate\Support\Facades\Event;
use App\Image\Facade as Image;
use Illuminate\Support\Facades\File;
use App\Models\Database\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Product::query())
            ->setDefaultOrder(['field' => 'created_at', 'keyword' => 'desc'])
            ->onlineColumn('status', ['sortable' => true, 'label' => ''])
            ->imageColumn('image', ['sortable' => false, 'label' => __('lang.images')])
            ->column('name', ['sortable' => true, 'label' => __('lang.name')])
            ->column('created_at', ['sortable' => true, 'label' => __('lang.created-at')])
            ->linkColumn(__('lang.edit'), [], function ($model) {
                return "<a href='" . route('admin.product.edit', $model->id) . "'><i class='fa fa-edit' aria-hidden='true'></i></a>";
            })
            ->linkColumn(__('lang.delete'), [], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->name}\")'><i class='fa fa-trash' aria-hidden='true'></i></a>";
            })
            ->setPagination(100);

        return view('admin.product.index')
            ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.new-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $product = Product::create($request->all());
        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }

        return redirect()->route('admin.product.edit', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorfail($id);

        return view('admin.product.edit')
            ->with('model', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $effects = [];
        $applied_on = [];

        if($request->filters){
            foreach ($request->filters as $key => $value) {

                $effects[] = $value;
                $applied_on[] = $key;

                ProductImage::where('id', $key)
                    ->update(['filters' => $value]);
            }
        }

        try {
            Event::fire(new ProductBeforeSave($request));

            $product = Product::findorfail($id);

            if ($request->slug == $product->slug){
                $product->saveProduct($request);
                Event::fire(new ProductAfterSave($product, $request));
            }
            if ($request->slug != $product->slug){
                $slugs = Product::all()->pluck('slug')->toArray();
                if (!in_array($request->slug, $slugs)){
                    $product->saveProduct($request);
                    Event::fire(new ProductAfterSave($product, $request));
                } else {
                    return redirect()->back()->with('slug', __('lang.slug-unique-fail'));
                }
            }

        } catch (\Exception $e) {
            throw new \Exception('Error in Saving Product: ' . $e->getMessage());
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.product.index');
    }

    /**
     * Upload image file and resize it.
     *
     */
    public function uploadImage(Request $request)
    {
        
        $image = $request->file('image');
        $tmpPath = str_split(strtolower(str_random(3)));

        $url = url()->previous();

        $checkDirectory = 'catalog/images/' . implode('/', $tmpPath);

        $image = Image::upload($image, $checkDirectory);

        $tmp = $this->_getTmpString();

        return view('admin.product.upload-image')
            ->with('image', $image)
            ->with('tmp', $tmp);
    }

    /**
     * Delete image file
     */
    public function deleteImage(Request $request)
    {
        $path = $request->get('path');

        LocalFile::deleteImages($path);

        return JsonResponse::create(['status' => true]);
    }

    /**
     * Return random string only lower and without digits.
     */
    public function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
