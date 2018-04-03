<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule['name'] = "required|max:255";
        $rule['slug'] = "required";
        $rule['price'] = "required";
        $rule['description'] = "required";
        $rule['status'] = "required";

        $rule['discount'] = "required";
        $rule['discount_price'] = "required_if:discount,1";

        return $rule;
    }
}
