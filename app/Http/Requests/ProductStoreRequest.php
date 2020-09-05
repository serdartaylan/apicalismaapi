<?php

namespace App\Http\Requests;

class ProductStoreRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|min:10|max:20',
            'slug' => 'required|min:10|max:20',
            'price' => 'required|max:50|regex:/^\d+(\.\d{1,2})?$/', // double validator
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ürün ismini yazınız',
            'name.min' => 'ürün ismi en az 10 karakterli olabilir',
            'name.max' => 'ürün ismi en fazla 20 karakterli olabilir',
            'slug.required' => 'slug bos olamaz',
            'slug.min' => 'slug en az 10 karakterli olabilir',
            'slug.max' => 'slug en fazla 20 karakterli olabilir',
            'price.required' => 'ürün fiyatını yazınız',
            'price.regex' => 'ürün fiyatını yazınız',
            'price.max' => 'ürün fiyatı en fazla 50 olabilir',
        ];
    }
}
