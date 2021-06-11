<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'author'=>'required|string|max:100',
            'title'=>'required|string|max:100',
            'publisher'=>'required|string|max:100',
            'year'=>'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required'=>"入力必須です",
            'string'=>"文字を入力してください",
            'max'=>"100字以内で入力して下さい",
            'numeric'=>"数字を入力してください",
        ];
    }
}
