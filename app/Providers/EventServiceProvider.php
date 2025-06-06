<?php

namespace App\Providers;

use App\Listeners\UploadListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use UniSharp\LaravelFilemanager\Events\ImageWasDeleted;
use UniSharp\LaravelFilemanager\Events\ImageWasUploaded;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ImageWasUploaded::class => [
            UploadListener::class,
        ],
        ImageWasDeleted::class => [
            UploadListener::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            \SocialiteProviders\Telegram\TelegramExtendSocialite::class.'@handle',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
