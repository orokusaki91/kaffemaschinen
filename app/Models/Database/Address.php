<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends BaseModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];  
    protected $fillable = [
        'user_id',
        'type',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'postcode',
        'city',
        'state',
        'country_id',
        'phone'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getCountryIdAttribute()
    {

        if (isset($this->attributes['country_id']) && $this->attributes['country_id'] > 0) {
            return $this->attributes['country_id'];
        }

        $defaultCountry = Configuration::getConfiguration('kaffemaschinen_address_default_country');

        if (isset($defaultCountry)) {
            return $defaultCountry;
        }

        return "";
    }
}