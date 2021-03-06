<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
     
    public function attributes()
   {
    return [
        'price' => '価格',
    ];
   } 
    public function rules()
    {
        return [
           'price'=>'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'price'=>'金額は整数で入力してください。',
            ];
    }
}
