<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\Setting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Menu extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(public Page $page)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $settings = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $messages = Page::find(6);

        return view('components.menu', compact('menu', 'settings', 'messages'));
    }
}