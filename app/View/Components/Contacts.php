<?php

namespace App\View\Components;

use App\Models\Section;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Contacts extends Component
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
        $settings = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));

        return view('components.contacts', compact('settings'));
    }
}
