<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class CategoryRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validationRule = [];
        $validationRule['name'] = 'required|max:255';
        if ($this->getMethod() == 'POST') {
            $validationRule['slug'] = 'required|max:255|alpha_dash|unique:categories';
        }
        if ($this->getMethod() == 'PUT') {
            $validationRule['slug'] = 'required|max:255|alpha_dash';
        }

        return $validationRule;
    }
}