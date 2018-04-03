<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Database\Category;
use Illuminate\Http\Request;
use App\DataGrid\Facade as DataGrid;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = DataGrid::model(Category::query())
            ->column('name', ['label' => __('lang.name'), 'sortable' => true])
            ->column('main_category', ['label' => __('lang.main-category'), 'sortable' => false])
            ->column('slug', ['sortable' => true])
            ->linkColumn(__('lang.edit'), [], function ($model) {
               return "<a href='" . route('admin.category.edit', $model->id) . "'>". __('lang.edit') ."</a>";
            })
            ->linkColumn(__('lang.delete'), [], function ($model) {
                return "<a href='#' onclick='showDeleteModal({$model->id}, \"{$model->name}\")'>". __('lang.delete') ."</a>";
            })
            ->setPagination(100);

        return view('admin.category.index')
            ->with('dataGrid', $dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->parent_id == ''){

            $allCat = Category::where('parent_id', null)->count();

            if ($allCat >= 9){
                return redirect()->back()->with('category', __('front.category-max'));
            }
        }

        Category::create($request->all());

        return redirect()->route('admin.category.index');
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
        $category = Category::findorfail($id);

        return view('admin.category.edit')
            ->with('model', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (empty($request->parent_id)){

            $allCat = Category::where('parent_id', null)->count();

            if ($allCat >= 9){
                return redirect()->back()->with('category', __('front.category-max'));
            }
        }

        $category = Category::findorfail($id);
        $category->update($request->all());

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        foreach ($category->children as $child) {
            $child->parent_id = 0;
            $child->update();
        }

        $category->delete();
        return redirect()->route('admin.category.index');
    }
}