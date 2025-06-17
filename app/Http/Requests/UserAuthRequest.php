<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'login' => ['required','string', 'exists:users,login'],
            'remember' => 'boolean',
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => __('lang.Введите логин'),
            'login.exists' => __('lang.Такого пользователя не существует'),
            'password.required' => __('Введите пароль')
        ];
    }
}
