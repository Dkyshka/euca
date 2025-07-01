<?php

namespace App\View\Components;

use App\Models\Banner;
use App\Models\CargoLoading;
use App\Models\Section;
use App\Models\Transport;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransportSearch extends Component
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
        $transports = Transport::where('status', Transport::IN_PROGRESS)->orderBy('id', 'desc')->paginate(15);
        $cargoLoadings = CargoLoading::where('company_id', auth()->user()?->company?->id)->where('status', CargoLoading::IN_PROGRESS)->orderBy('id', 'desc')->get();

        return view('components.transport-search', compact(
            'transports',
            'bannerSideBar',
            'bannerSection',
            'cargoLoadings')
        );
    }
}
