<?php

namespace App\View\Components;

use App\Models\Banner;
use App\Models\CargoLoading;
use App\Models\Section;
use App\Models\Transport;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

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

        $query = Transport::query()->where('status', Transport::IN_PROGRESS);

        if (request()->filled('country')) {
            $query->where('country', 'like', '%' . request()->country . '%');
        }

        if (request()->filled('final_country')) {
            $query->where('final_country', 'like', '%' . request()->final_country . '%');
        }

        if (request()->filled('capacity')) {
            $query->where('capacity', '>=', request()->capacity);
        }

        if (request()->filled('capacity_to')) {
            $query->where('capacity', '<=', request()->capacity_to);
        }

        if (request()->filled('volume')) {
            $query->where('volume', '>=', request()->volume);
        }

        if (request()->filled('volume_to')) {
            $query->where('volume', '<=', request()->volume_to);
        }

        if (request()->filled('loading_date')) {
            $query->where('loading_date', request()->loading_date); // или другой формат
        }

        if (request()->filled('body_type')) {
            $query->where('body_type', request()->body_type);
        }

        if (request()->filled('ready_date')) {
            $today = now()->toDateString();

            switch (request()->ready_date) {
                case 'today':
                    $query->whereDate('ready_date', $today);
                    break;
                case 'tomorrow':
                    $query->whereDate('ready_date', now()->addDay()->toDateString());
                    break;
                case 'today_and_tomorrow':
                    $query->whereBetween('ready_date', [$today, now()->addDay()->toDateString()]);
                    break;
                case 'three_days':
                    $query->whereBetween('ready_date', [$today, now()->addDays(2)->toDateString()]);
                    break;
                case 'plus_three_days':
                    $query->whereBetween('ready_date', [$today, now()->addDays(3)->toDateString()]);
                    break;
                case 'workdays':
                    $query->where(function ($q) {
                        $q->whereNull('ready_date')
                            ->where('availability_mode', 'workdays');
                    });
                    break;
                case 'daily':
                    $query->where(function ($q) {
                        $q->whereNull('ready_date')
                            ->where('availability_mode', 'daily');
                    });
                    break;
            }
        }

        if (request()->filled('payment')) {
            switch (request()->payment) {
                case 'no_haggling':
                case 'payment_request':
                    $query->where('payment_type', request()->payment);
                    break;
                case 'with_vat_cashless':
                    $query->whereNotNull('with_vat_cashless');
                    break;
                case 'without_vat_cashless':
                    $query->whereNotNull('without_vat_cashless');
                    break;
                case 'cash':
                    $query->whereNotNull('cash');
                    break;
            }
        }

        $transports = $query->orderBy('id', 'desc')->paginate(15);

        $cargoLoadings = CargoLoading::where('company_id', auth()->user()?->company?->id)->where('status', CargoLoading::IN_PROGRESS)->orderBy('id', 'desc')->get();

        return view('components.transport-search', compact(
            'transports',
            'bannerSideBar',
            'bannerSection',
            'cargoLoadings')
        );
    }
}
