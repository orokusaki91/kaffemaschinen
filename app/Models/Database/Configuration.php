<?php

namespace App\Models\Database;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['configuration_key', 'configuration_value'];

    public function getValue($key)
    {
        $row = $this->where('configuration_key', '=', $key)->first();
        if ($row != null) {
            return $row->configuration_value;
        }

        return null;
    }

    public static function getConfiguration($key)
    {
        $model = new static;
        return $model->getValue($key);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __get($key)
    {
        $val = parent::__get($key);
        if (null !== $val) {
            return $val;
        }

        $val = $this->getValue($key);

        if (null !== $val) {
            return $val;
        }

        return null;
    }
}
