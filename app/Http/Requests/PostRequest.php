<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'required',
            'solution' => 'required|max:255',
            'user_id' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
                'content.required' => ':attributeを入力してください',
                'solution.required' => ':attributeを入力してください',
                'user_id.required' => ':attributeがありません',
                'solution.max' => ':attributeの文字数は255文字までです',
                'user_id.numeric' => ':attributeは数字のみ適用されます',
        ];

    }

    public function attributes()
    {
        return [
                'content' => '"やらないこと"',
                'solution' => '"解決策"',   
                'user_id' => '"ユーザーID"',
        ];
    }

    
}
