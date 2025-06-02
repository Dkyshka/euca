<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
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
use Illuminate\Support\Facades\DB;
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
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)->where('status', CargoLoading::IN_PROGRESS)->orderByDesc('id')->get();

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
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)->where('status', CargoLoading::COORDINATION)->orderByDesc('id')->get();

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
        $cargoLoadings = CargoLoading::where('company_id', $user?->company?->id)
            ->where('status', CargoLoading::IN_PERFORMANCE)->orderByDesc('id')->get();

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

    public function store(CargoRequest $request)
    {
        try {
        DB::beginTransaction();

        $cargoLoading = CargoLoading::create([
            'company_id' => $request->input('company_id'),
            'country' => $request->input('country'),
//            'address' => $request->input('address'),
            'time_at' => $request->input('time_at'),
            'time_to' => $request->input('time_to'),
            'is_24h' => $request->input('is_24h'),
            'final_unload_country' => $request->input('final_unload_country'),
            'final_unload_city' => $request->input('final_unload_city'),
//            'final_unload_address' => $request->input('final_unload_address'),
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
            'constant_frequency' => $request->input('constant_frequency'),
        ]);

        DB::commit();
        return redirect()->route('workCargos');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function edit($lang, CargoLoading $cargoLoading)
    {
        $this->page = Page::findOrFail(11);
        $cargoTypes = CargoType::all();
        $packages = Package::all();

        return view('users.cargos.cargos-edit', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
            'cargoLoading' => $cargoLoading,
            'cargoTypes' => $cargoTypes,
            'packages' => $packages,
        ]);
    }
}
