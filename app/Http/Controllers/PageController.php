<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PageController extends Controller
{

    public function index(string $locale, Page $page): View
    {
        $settings = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $footer = Cache::remember('footer_menu', now()->addHour(), function () {
            return Page::whereStatus(1)
                ->whereNull('parent_id')
                ->whereFooter(1)
                ->orderBy('id')
                ->get();
        });

        if($page->id === null) {
            $page = Page::whereSlug('/')->firstOrFail();
        }

        return view('index', compact('page', 'settings', 'footer', 'menu'));
    }
}
