<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'review'=>'required|string|max:400',
            's_page'=>'required|numeric',
            'e_page'=>'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required'=>"入力必須です",
            'max'=>"400字以内で入力して下さい",
            'string'=>"文字を入力して下さい",
            'numeric'=>"数字を入力して下さい"
        ];
    }
}
