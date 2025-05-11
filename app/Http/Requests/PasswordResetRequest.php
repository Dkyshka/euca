<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'new_password' => 'required|min:8|regex:/^(?=.*[a-zA-Z].{8,})(?=.*\d)/',
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required' => 'Введите пароль',
            'new_password.min' => 'Пароль должен быть минимум 8 символов',
            'new_password.regex' => 'Пароль должен содержать 8 букв и минимум 1 цифру',
        ];
    }
}
