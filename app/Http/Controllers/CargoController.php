<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\CargoLoading;
use App\Models\CargoType;
use App\Models\Package;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class CargoController extends Controller
{
    public Model $page;
    public Setting $setting;
    public Collection $footer;
    public Collection $menu;

    public function __construct()
    {
        $this->menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $this->setting = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $this->footer = Cache::remember('footer_menu', now()->addHour(), function () {
            return Page::whereStatus(1)
                ->whereNull('parent_id')
                ->whereFooter(1)
                ->orderBy('id')
                ->get();
        });
    }

    public function cargos($locale)
    {
        $this->page = Page::findOrFail(11);

        return view('users.cargos.cargos', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
        ]);
    }

    public function workCargos()
    {
        $user = auth()->user();
        $this->page = Page::findOrFail(11);
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)->get();

        return view('users.cargos.work-cargos', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoLoadings' => $cargoLoadings,
        ]);
    }

    public function сoordinations()
    {
        $user = auth()->user();
        $this->page = Page::findOrFail(11);
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)->get();

        return view('users.cargos.coordinations-cargos', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoLoadings' => $cargoLoadings,
        ]);
    }

    public function execution()
    {
        $user = auth()->user();
        $this->page = Page::findOrFail(11);
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)->get();

        return view('users.cargos.execution-cargos', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoLoadings' => $cargoLoadings,
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        if (!$user?->company) {
            return redirect()->back()->withErrors(['company' => 'У вас нет привязанной компании. Создайте её в настройках профиля']);
        }

        $this->page = Page::findOrFail(11);
        $cargoTypes = CargoType::all();
        $packages = Package::all();

        return view('users.cargos.cargos-create', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoTypes' => $cargoTypes,
            'packages' => $packages,
        ]);
    }

    public function update()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
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
            'package_id' => ['sometimes', 'exists:packages,id'],
            // Количество упаковки
            'quantity' => ['sometimes', 'numeric'],
            // компания груза
            'company_id' => ['required', 'numeric', 'exists:companies,id'],
            // страна загрузки
            'country' => ['required', 'string', 'max:255'],
            // адрес загрузки
            'address' => ['required', 'string', 'max:255'],
            // Когда готов груз
            'when_type' => ['required', Rule::in([1, 2, 3])],

            'ready_date' => [
                Rule::requiredIf(fn () => request('when_type') == 1),
                'date',
            ],

            'constant_frequency' => [
                Rule::requiredIf(fn () => request('when_type') == 2),
                Rule::in(['daily', 'workdays']),
            ],

            // archive_after_days — не обязательный
            'archive_after_days' => ['nullable', 'integer', 'min:0'],

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
            'final_unload_address' => ['required', 'string', 'max:255'],

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

            'body_types' => ['array'],

            'loading_types' => ['array'],

            'unloading_types' => ['array'],

            'payment_type' => ['required', Rule::in(['negotiable', 'no_haggling', 'payment_request'])],

            'with_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:without_vat_cashless,cash'
            ],
            'without_vat_cashless' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,cash'
            ],
            'cash' => [
                'nullable',
                'numeric',
                'required_without_all:with_vat_cashless,without_vat_cashless'
            ],
            'currency' => ['nullable', 'string'],
            'on_cart' => ['nullable', Rule::in(['0', '1'])],
            'counter_offers' => ['nullable', Rule::in(['0', '1'])],
            'payment_via' => ['nullable', 'numeric'],
        ]);

        $cargoLoading = CargoLoading::create([
            'company_id' => $request->input('company_id'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
            'time_at' => $request->input('time_at'),
            'time_to' => $request->input('time_to'),
            'is_24h' => $request->input('is_24h'),
            'final_unload_country' => $request->input('final_unload_country'),
            'final_unload_address' => $request->input('final_unload_address'),
            'final_unload_date_from' => $request->input('final_unload_date_from'),
            'final_unload_date_to' => $request->input('final_unload_date_to'),
            'final_unload_datetime_from' => $request->input('final_unload_datetime_from'),
            'final_unload_datetime_to' => $request->input('final_unload_datetime_to'),
            'final_is_24h' => $request->input('final_is_24h'),
            'body_types' => $request->input('body_types'),
            'loading_types' => $request->input('loading_types'),
            'unloading_types' => $request->input('unloading_types'),
            'payment_type' => $request->input('payment_type'),
            'with_vat_cashless' => $request->input('with_vat_cashless'),
            'without_vat_cashless' => $request->input('without_vat_cashless'),
            'cash' => $request->input('cash'),
            'currency' => $request->input('currency'),
            'on_cart' => $request->input('on_cart'),
            'counter_offers' => $request->input('counter_offers'),
            'payment_via' => $request->input('payment_via'),
        ]);

        Cargo::create([
            'cargo_loading_id' => $cargoLoading->id,
            'title' => $request->input('title'),
            'weight' => $request->input('weight'),
            'weight_type' => $request->input('weight_type'),
            'volume' => $request->input('volume'),
            'package_id' => $request->input('package_id'),
            'quantity' => $request->input('quantity'),
            'ready_date' => $request->input('ready_date'),
            'archive_after_days' => $request->input('archive_after_days'),
            'length' => $request->input('length'),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
            'diameter' => $request->input('diameter'),
        ]);

        return redirect()->route('cargos');
    }

    public function edit(CargoLoading $cargoLoading)
    {
        $this->page = Page::findOrFail(11);

        return view('users.cargos.cargos-edit', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoLoading' => $cargoLoading,
        ]);
    }
}
