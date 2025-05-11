<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UserAdminRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string'],
            'email'            => ['required', 'string', 'email', Rule::unique('users')->ignore($this->user->id ?? '')],
            'password'         => [Rule::excludeIf(!empty($this->user->id) && !request()->password), 'required', 'string'],
            'role_id'          => ['required', Rule::in([1, 2, 3, 4])],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Введите Имя',
            'email.required' => 'Введите E-mail',
            'email.email' => 'Введите корректный E-mail',
            'email.unique' => 'Такой E-mail уже занят',
            'password.required' => 'Введите пароль',
            'role_id.required' => 'Выберите роль',
            'role_id.in' => 'Выберите правильное значение для роли',
        ];
    }

}
