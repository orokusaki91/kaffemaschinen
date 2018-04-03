<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'description', 'image', 'website'];
}