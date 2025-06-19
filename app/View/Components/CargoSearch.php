<?php

namespace App\View\Components;

use App\Models\Banner;
use App\Models\CargoLoading;
use App\Models\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CargoSearch extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Section $section)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $bannerSideBar = Banner::where('type_banner', 'header')->first();
        $bannerSection = Banner::where('type_banner', 'section')->first();

        $cargoLoadings = CargoLoading::where('status', CargoLoading::IN_PROGRESS)->orderByDesc('id')->paginate(15);

        return view('components.cargo-search', compact('cargoLoadings', 'bannerSection', 'bannerSideBar'));
    }
}
