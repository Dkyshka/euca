<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CargoRequest extends FormRequest
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
            // название груза
            'title' => ['required', 'string', 'min:3', 'max:255'],
            // вес груза
            'weight' => ['required', 'numeric'],
            // Тип веса груза
            'weight_type' => ['required', Rule::in(['t', 'kg'])],
            // Объём груза
            'volume' => ['required', 'numeric'],

            'length' => ['nullable', 'numeric'],

            'width' => ['nullable', 'numeric'],

            'height' => ['nullable', 'numeric'],

            'diameter' => ['nullable', 'numeric'],

            // Упаковка
            'package_id' => ['sometimes', 'nullable', 'exists:packages,id'],
            // Количество упаковки
            'quantity' => ['sometimes', 'nullable', 'numeric', 'max:3000'],
            // компания груза
            'company_id' => ['required', 'numeric', 'exists:companies,id'],
            // страна загрузки
            'country' => ['required', 'string', 'max:255'],
            // адрес загрузки
//            'address' => ['required', 'string', 'max:255'],
            // Когда готов груз
            'when_type' => ['required', Rule::in([1, 2, 3])],

            'ready_date' => [
                Rule::requiredIf(fn () => request('when_type') == 1),
                'nullable',
                'date',
            ],

            'constant_frequency' => [
                Rule::requiredIf(fn () => request('when_type') == 2),
                'nullable',
                Rule::in(['daily', 'workdays']),
            ],

            // archive_after_days — не обязательный
            'archive_after_days' => ['nullable', 'integer', 'min:0', 'max:5'],

            'time_at' => [
//                Rule::requiredIf(fn () => !request('is_24h')),
                'nullable',
                'date_format:H:i',
            ],
            'time_to' => [
//                Rule::requiredIf(fn () => !request('is_24h')),
                'nullable',
                'date_format:H:i',
                'after:time_at', // end должен быть позже начала
            ],

            'is_24h' => ['nullable', Rule::in(['0', '1'])],

            // Населенный пункт и адрес разгрузки
            'final_unload_city' => ['required', 'string', 'max:255'],
//            'final_unload_address' => ['required', 'string', 'max:255'],

            // Дата разгрузки: от и до (может быть диапазон)
            'final_unload_date_from' => ['nullable', 'date'],
            'final_unload_date_to' => ['nullable', 'date', 'after_or_equal:final_unload_date_from'],

            // Время разгрузки: если не круглосуточно — обязательно
            'final_unload_datetime_from' => [
                'nullable',
                'date_format:H:i',
            ],
            'final_unload_datetime_to' => [
                'nullable',
                'date_format:H:i',
                'after:final_unload_datetime_from',
            ],

            // Круглосуточно чекбокс
            'final_is_24h' => ['nullable', Rule::in(['0', '1'])],

            'body_types' => ['required', 'array', 'min:1'],

            'loading_types' => ['array'],

            'unloading_types' => ['array'],

            'payment_type' => ['required', Rule::in(['negotiable', 'no_haggling', 'payment_request'])],

//            'with_vat_cashless' => [
//                'nullable',
//                'numeric',
//                'required_without_all:without_vat_cashless,cash'
//            ],
//            'without_vat_cashless' => [
//                'nullable',
//                'numeric',
//                'required_without_all:with_vat_cashless,cash'
//            ],
//            'cash' => [
//                'nullable',
//                'numeric',
//                'required_without_all:with_vat_cashless,without_vat_cashless'
//            ],
            'with_vat_cashless' => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn () => request('payment_type') !== 'payment_request'
                    && !request('without_vat_cashless')
                    && !request('cash')),
            ],

            'without_vat_cashless' => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn () => request('payment_type') !== 'payment_request'
                    && !request('with_vat_cashless')
                    && !request('cash')),
            ],

            'cash' => [
                'nullable',
                'numeric',
                Rule::requiredIf(fn () => request('payment_type') !== 'payment_request'
                    && !request('with_vat_cashless')
                    && !request('without_vat_cashless')),
            ],

            'currency' => ['nullable', 'string'],
            'on_cart' => ['nullable', Rule::in(['0', '1'])],
            'counter_offers' => ['nullable', Rule::in(['0', '1'])],
            'payment_via' => ['nullable', 'numeric'],
        ];
    }
}
