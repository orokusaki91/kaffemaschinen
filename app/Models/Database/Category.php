<?php

namespace App\Models\Database;

use Illuminate\Support\Collection;

class Category extends BaseModel
{
    protected $fillable = ['parent_id', 'name', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function getCategoryOptions() {
        $model = new static;
        $options = Collection::make(['' => __('lang.please-select')] + $model->all()->pluck('name', 'id')->toArray());

        return $options;
    }

    public function topParent()
    {
        if ($this->parentCategory)
            return $this->parentCategory->topParent();

        return $this;
    }
    
    public function getMainCategoryAttribute()
    {
        $mainCategory = $this->where('id', '=', $this->attributes['parent_id'])->get()->first();

        return (null != $mainCategory) ? $mainCategory->name : '('.__('lang.main-category').')';
    }

    public function getParentNameAttribute()
    {
        $parentCategory = $this->where('id', '=', $this->attributes['parent_id'])->get()->first();

        return (null != $parentCategory) ? $parentCategory->name : '';
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getAllCategories()
    {
        $data = [];

        $rootCategories = $this->where('parent_id', '=', null)->orWhere('parent_id', '=', '0')->get();
        $data = $this->list_categories($rootCategories);

        return $data;
    }

    public function list_categories($categories)
    {
        $data = [];

        foreach ($categories as $category)
        {
            $childs = $this->getChilds($category->id);
            $products = $category->products->where('status', '=', 1);
            if (count($childs)>0 || count($products)>0){

                $data[] = [
                    'object' => $category,
                    'children' => $this->list_categories($category->children),
                ];

            }
        }

        return $data;
    }

    public function getChilds($id)
    {
        return $this->where('parent_id', '=', $id)->get();
    }

    public function getActiveClass($slug)
    {
        dd($slug);
    }
/*
    public function getFilters()
    {
        $attrs = Collection::make([]);
        $productIds = $this->products->pluck('id');

        $productVarcharCollection = ProductVarcharCollection::whereIn('product_id', $productIds)->get()->unique('product_attribute_id');

        foreach ($productVarcharCollection as $varcharValue) {
            $attrs->push(Attribute::find($varcharValue->product_attribute_id));
        }
        return $attrs;
    }
*/
}