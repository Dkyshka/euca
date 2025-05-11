<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewsRequest extends FormRequest
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
            'name_ru' => ['required'],
            'name_uz' => 'required',
            'name_en' => 'required',
            'status' => [Rule::in([0, 1])],
            'markup' => '',
            'filepath' => '',
            'apply' => '',
        ];
    }

    public function messages(): array
    {
        return [
            'name_ru.required' => 'Введите имя',
            'name_uz.required' => 'Введите имя uz',
            'name_en.required' => 'Введите имя en',
        ];
    }
}
