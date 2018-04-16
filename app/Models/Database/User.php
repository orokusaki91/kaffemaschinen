<?php

namespace App\Models\Database;

use App\Image\LocalFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'first_name', 'last_name', 'email', 'password', 'phone', 'is_company', 'company_name', 'image_path', 'status', 'language', 'confirmed', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getImagePathAttribute()
    {
        return (empty($this->attributes['image_path'])) ? null : new LocalFile($this->attributes['image_path']);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function userViewedProducts()
    {
        return $this->hasMany(UserViewedProduct::class);
    }

    public function getShippingAddress()
    {
        $address = $this->addresses()->where('type', '=', 'SHIPPING')->first();
        return $address;
    }

    public function getShippingAddresses()
    {
        $addresses = $this->addresses()->where('type', '=', 'SHIPPING')->get();
        return $addresses;
    }

    public function getBillingAddress()
    {
        $address = $this->addresses()->where('type', '=', 'BILLING')->first();
        return $address;
    }
}
