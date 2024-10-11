<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'todo' フィールドが必須であり、文字列であることを要求
            'todo' => 'required|string|max:255',
        ];
    }
    
    public function authorize()
    {
        // このリクエストが常に許可される場合は true を返します
        return true;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            // エラーメッセージをカスタマイズ
            'todo.required' => 'ToDoを入力してください。',
            'todo.string'   => 'ToDoには文字列を入力してください。',
            'todo.max'      => 'ToDoは255文字以内で入力してください。',
        ];
    }
}

