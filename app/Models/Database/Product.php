<?php
namespace App\Models\Database;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Image\LocalFile;
use Illuminate\Support\Str;

class Product extends BaseModel
{
    use SoftDeletes, Orderable;

    protected $dates = ['deleted_at'];
    protected $appends = ['image'];
    protected $fillable =['type', 'name', 'slug', 'description', 'pdv', 'status', 'available', 'unavailable_text', 'track_stock', 'is_taxable', 'page_title', 'page_description', 'price', 'discount', 'discount_price', 'delivery', 'new_product', 'hit_product', 'contact_only', 'has_packaging', 'packaging'];

    public static function getCollection()
    {
        $model = new static;
        $products = $model->all();
        $productCollection = new ProductCollection();
        $productCollection->setCollection($products);
        return $productCollection;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $slug = Str::slug($model->name);
            $count = static::where("slug", "=", $slug)->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
    
    public static function getProductsBySlug($slug)
    {
        $model = new static;
        return $model->where('slug', '=', $slug)->first();
    }

    public function saveProduct($request)
    {
        /**
         * SAVING PRODUCT BASIC FIELDS
         */
        $this->update($request->all());

        /**
         * SAVING PRODUCT PRICES
         */
        /*
        if ($this->prices()->get()->count() > 0) {
            $this->prices()->get()->first()->update(['price' => $request->get('price')]);
        } else {
            $this->prices()->create(['price' => $request->get('price')]);
        }
        */

        /**
         * SAVING PRODUCT IMAGES
         */
        if (null !== $request->get('image')) {
            $exitingIds = $this->images()->get()->pluck('id')->toArray();
            foreach ($request->get('image') as $key => $data) {
                if (is_int($key)) {
                    if (($findKey = array_search($key, $exitingIds)) !== false) {
                        $productImage = ProductImage::findorfail($key);
                        $productImage->update($data);
                        unset($exitingIds[$findKey]);
                    }
                    continue;
                }
                ProductImage::create($data + ['product_id' => $this->id, 'filters' => $request->filters[$key]]);
            }
            if (count($exitingIds) > 0) {
                ProductImage::destroy($exitingIds);
            }
        }

        /**
         * SAVING PRODUCT CATEGORIES
         */
        if (count($request->get('category_id')) > 0) {
            $this->categories()->sync($request->get('category_id'));
        }
    }

    public function getImages()
    {
        $id = $this->id;
        $images = $this->images()->where('product_id', '=', $id)->get();

        return $images;
    }
    
    public function getMainImageAttribute()
    {
        return $this->images()->where('is_main_image', '=', 1)->first();
    }

    public function getImageAttribute()
    {
        $defaultPath = "/front/assets/img/default-product.jpg";
        $image = $this->images()->where('is_main_image', '=', 1)->first();

        if (null === $image) {
            return new LocalFile($defaultPath);
        }

        if ($image->path instanceof LocalFile) {
            return $image->path;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_products');
    }
}