<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
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
            'theme_name'=>'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required'=>"入力必須です",
            'max'=>"50字以内で入力して下さい",
            'string'=>"文字を入力して下さい",
        ];
    }
}
