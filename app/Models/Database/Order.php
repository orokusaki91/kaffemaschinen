<?php

namespace App\Models\Database;

class Order extends BaseModel
{
    protected $fillable = [
        'shipping_address_id',
        'billing_address_id',
        'user_id',
        'shipping_option',
        'payment_option',
        'order_status_id'
    ];

    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable', 'order_items')->withTrashed()->withPivot('price', 'qty');
    }

    public function packages()
    {
        return $this->morphedByMany(Package::class, 'orderable', 'order_items')->withTrashed()->withPivot('price', 'qty');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderReturnRequest() {
        return $this->hasOne(OrderReturnRequest::class);
    }

    public function getShippingAddressAttribute()
    {
        $shippingAddress = Address::withTrashed()->find($this->attributes['shipping_address_id']);

        return $shippingAddress;
    }

    public function getOrderStatusTitleAttribute()
    {
        return $this->orderStatus->name;
    }

    public function getBillingAddressAttribute()
    {
        $address = Address::withTrashed()->find($this->attributes['billing_address_id']);

        return $address;
    }
}