<?php

namespace App\Models\Database;

class Visitor extends BaseModel
{
    protected $fillable = ['ip_address', 'url', 'agent', 'user_id'];
}