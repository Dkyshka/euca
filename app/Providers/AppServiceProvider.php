<?php

namespace App\Providers;

use App\Services\TranslatorFreeService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->singleton('google.translator', function () {
//            return new GoogleTranslate(); // по умолчанию auto -> en
//        });

//        $this->app->singleton(TranslatorFreeService::class, function () {
//            return new TranslatorFreeService();
//        });
//
//        $this->app->alias(TranslatorFreeService::class, 'custom.translator');

//        $this->app->singleton('google.translator', function () {
//            return new \App\Services\TranslatorFreeService();
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);

        RateLimiter::for('telegramWebhook', function ($request) {
            return Limit::perMinute(10)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
