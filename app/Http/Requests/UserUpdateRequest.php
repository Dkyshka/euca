<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'min:5', 'max:50'],
            'tel' => [
                'required',
                'string',
                'min:7',
                'max:17',
            ],
            'password' => [
                'sometimes',
                'nullable',
                'string',
                'min:8',
                'max:16',
            ],
            'inn' => [
                'required',
                'string',
                'min:8',
                'max:25'
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id ?? '')
            ],
            'file' => [
                'nullable',
                'file',
                'mimes:jpeg,jpg,png,avif',
                'max:2048',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => __('lang.Введите ФИО'),

            'full_name.min' => __('lang.ФИО должно содержать минимум 5 символов'),
            'full_name.max' => __('lang.ФИО должно содержать максимум 30 символов'),

            'phone.required' => __('lang.Введите телефон'),
            'phone.unique' => __('lang.Телефон занят'),

            'phone.regex' => __('lang.Телефон должен содержать только цифры'),
            'phone.min' => __('lang.Телефон должен содержать минимум 7 цифр'),
            'phone.max' => __('lang.Телефон не должен превышать 15 цифр'),

            'pinfl.required' => __('lang.Введите ПИНФЛ'),
            'pinfl.unique' => __('lang.ПИНФЛ занят'),

            'pinfl.regex' => __('lang.ПИНФЛ должен содержать только цифры'),
            'pinfl.min' => __('lang.ПИНФЛ должен содержать минимум 8 символов'),
            'pinfl.max' => __('lang.ПИНФЛ должен содержать максимум 15 символов'),
        ];
    }
}
