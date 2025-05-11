<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
            'page_id' => ['required', 'integer'],
            'name_ru' => ['required'],
            'name_uz' => '',
            'name_tr' => '',
            'name_en' => '',
            'slug' => ['required', 'min:3', Rule::unique('news')->ignore($this->news->id ?? '')],
            'status' => [Rule::in([0, 1])],
            'is_favorite' => [Rule::in([0, 1])],
            'markup' => '',
            'filepath' => '',
            'apply'
        ];
    }

    public function messages(): array
    {
        return [
            'page_id.required' => 'Выберете раздел',
            'page_id.integer' => 'Введите числа',
            'name_ru.required' => 'Введите имя',
            'slug.required' => 'Заполните поле',
            'slug.unique' => 'Такое имя уже существует',
            'slug.min' => 'Поле должно быть больше 3 символов',
        ];
    }
}
