<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'phone' => str_replace(' ', '', $this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required', Rule::in([Role::CARRIER, Role::CONSIGNOR, Role::FORWARDED, Role::LOGISTIC])],
            'full_name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8'],
            'login' => [
                'required',
                'string',
                'min:6',
                'max:256',
                'regex:/^[^\s,\/\?!#\$%\^&\*=<>\|¦"]+$/u',
                Rule::unique('users', 'login'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => __('lang.Укажите роль'),
            'email.required' => __('lang.Введите email'),
            'full_name.required' => __('Ведите ФИО'),
            'email.unique' => __('lang.Такой пользователь уже существует'),
            'email.email' => __('lang.Введите корректный email'),
            'login.required' => __('lang.Поле логин обязательно для заполнения'),
            'login.min' => __('lang.Логин должен быть не короче 6 символов'),
            'login.max' => __('lang.Логин не должен превышать 256 символов'),
            'login.unique' => __('lang.Такой логин уже используется'),
            'login.regex' => __('lang.Логин не должен содержать пробелы или символы:').' / ? ! # $ % ^ & * = < > \\ | ¦ "',
            'phone.required' => __('lang.Введите телефон'),
            'password.required' => __('lang.Введите пароль'),
            'password.min' => __('lang.Пароль должен быть минимум 8 символов'),
        ];
    }
}
