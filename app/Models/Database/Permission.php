<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public static function getPermissionByName($name)
    {
        $instance = new static;
        return $instance->where('name', '=', $name)->first();
    }
}