<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'message' => 'required|max:255',
            'sendId' => 'required|numeric',
            
        ];
    }

    public function messages()
    {
        return [
                'message.required' => 'メッセージを入力してください',
                'message.max' => '文字数は255文字までです',
                'user_id.required' => 'ユーザー登録されておりません',
        ];

    }
}
