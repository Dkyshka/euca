<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
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
            'parent_id' => '',
            'name_ru' => ['required', 'string'],
            'name_uz' => '',
            'name_en' => '',
            'meta_title_ru' => '',
            'meta_title_uz' => '',
            'meta_title_en' => '',
            'description_ru' => '',
            'description_uz' => '',
            'description_en' => '',
            'slug' => ['required', 'min:1', Rule::unique('pages')->ignore($this->page->id ?? '')],
            'apply' => '',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name_ru.required' => 'Введите имя',
            'slug.required' => 'Введите URL',
            'slug.unique'   => 'Раздел с таким url уже существует',
            'slug.min'   => 'Url должен быть больше 3 символов',
        ];
    }
}
