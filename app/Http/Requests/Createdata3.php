<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Createdata3 extends FormRequest
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
            //カテゴリ追加画面のバリデーション
            'category_id' => 'required',
            'name' => 'required|max:20',
        ];
    }
}
