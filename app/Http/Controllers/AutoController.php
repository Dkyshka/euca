<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AutoController extends Controller
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

    public function autoPark()
    {
        $this->page = Page::findOrFail(11);

        return view('users.auto.auto-park', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
        ]);
    }

    public function drivers()
    {
        $this->page = Page::findOrFail(11);

        return view('users.drivers.drivers', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
        ]);
    }

    public function notifications()
    {
        $this->page = Page::findOrFail(11);

        return view('users.notifications.notifications', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
        ]);
    }

    public function notificationsInner()
    {
        $this->page = Page::findOrFail(11);

        return view('users.notifications.notification-inner', [
            'page' => $this->page,
            'setting' => $this->setting,
            'footer' => $this->footer,
            'menu' => $this->menu,
        ]);
    }
}
