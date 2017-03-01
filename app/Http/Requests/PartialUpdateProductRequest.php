<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateProductRequest extends FormRequest
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
        return [
            'name' => 'string|required_without_all:price, description, label',
            'price' => 'numeric|required_without_all:name, description, label|min:0',
            'description' => 'string|required_without_all:name, price, label',
            'seller_id' => 'required|min:1|integer',
            'label' => 'array:string|required_without_all:name, price, description'
        ];
    }
}