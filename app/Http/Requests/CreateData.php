<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
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
            //レコード追加画面のバリデーション
            'remind_date' => 'required|date',
            'title' => 'required|max:255',
            'text' => 'required|max:300',
            'category_id' => 'required',
        ];
    }
}
