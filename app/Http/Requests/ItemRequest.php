<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'item_name' => ['required', 'max:100'],
            'expire_date' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => '担当者を選択して下さい。',
            'user_id.integer' => '不正な担当者です。',
            'user_id.exists' => 'ユーザー一覧に存在しない担当者です。',
            'item_name.required' => '項目名が空白です。',
            'item_name.max' => '項目名は１００文字以下で入力して下さい。',
            'expire_date.required' => '期限が空白です。',
            'expire_date.date' => '不正な形式の期限です。',
        ];
    }
}
