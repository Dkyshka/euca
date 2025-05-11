<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(string $locale, Page $page, ?string $slug = null): View
    {
        $data = ArticleService::company($page, $slug);
        $menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $settings = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $footer = Cache::remember('footer_menu', now()->addHour(), function () {
            return Page::whereStatus(1)
                ->whereNull('parent_id')
                ->whereFooter(1)
                ->orderBy('id')
                ->get();
        });

        return view("articles.$data[template]",
            [
                'page' => $page,
                'article' => $data['model'],
                'menu' => $menu,
                'settings' => $settings,
                'footer' => $footer
            ]);
    }

    public function cargo(string $locale, Page $page, ?string $slug = null): View
    {
        $data = ArticleService::cargo($page, $slug);
        $menu = Page::whereStatus(1)->where('parent_id', null)->whereHeader(1)->orderBy('sort_order')->get();
        $settings = Cache::remember('site_settings', now()->addHour(), fn() => Setting::find(1));
        $footer = Cache::remember('footer_menu', now()->addHour(), function () {
            return Page::whereStatus(1)
                ->whereNull('parent_id')
                ->whereFooter(1)
                ->orderBy('id')
                ->get();
        });

        return view("articles.$data[template]",
            [
                'page' => $page,
//                'article' => $data['model'],
                'menu' => $menu,
                'settings' => $settings,
                'footer' => $footer
            ]);
    }
}
