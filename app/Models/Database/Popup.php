<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = ['package_id', 'title', 'image', 'active', 'end_date'];
    protected $dates = ['end_date'];
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}