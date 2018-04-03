<?php

namespace App\Models\Database;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes, Orderable;

    protected $dates = ['deleted_at'];
    protected $appends = ['image'];
    protected $fillable =['name', 'description', 'price', 'qty', 'tax_amount', 'pdv'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'package_products');
    }

    public function popups()
    {
        return $this->hasMany(Popup::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->products()->sum('price');
    }

    public function getPercentageAttribute()
    {
        if ($this->price < $this->total_price)
            return 100 - round(($this->price / $this->total_price) * 100);
        else
            return 100 - round(($this->total_price / $this->price) * 100);
    }

    public function getPercentageSignAttribute()
    {
        return ($this->price < $this->total_price) ? '-' : '+';
    }
}
