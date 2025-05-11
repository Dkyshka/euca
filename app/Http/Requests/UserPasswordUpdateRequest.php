<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required',
            'password' => 'required|confirmed|different:old_password|min:8|regex:/^(?=.*[a-zA-Z].{7,})(?=.*\d)/',
            'password_confirmation' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => __('Введите старый пароль'),
            'password.required' => __('Введите новый пароль'),
            'password.min' => __('lang.Пароль должен быть минимум 8 символов'),
            'password.regex' => __('lang.Пароль должен содержать 7 букв и минимум 1 цифру'),
            'password_confirmation.required' => __('Повторите пароль'),
            'password.confirmed' => __('Пароли не совпадают'),
            'password.different' => __('Новый пароль должен отличаться')
        ];
    }
}
