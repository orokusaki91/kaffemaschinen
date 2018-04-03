<?php
/**
 * Created by PhpStorm.
 * User: draga
 * Date: 08-Jan-18
 * Time: 20:39
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class UpdateOrderStatusRequest extends Request
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
        $rules = [];
        $rules['order_status_id'] = 'required';


        return $rules;
    }
}
