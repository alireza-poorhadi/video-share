<?php

namespace App\Providers;

use App\Models\Like;
use App\Models\Video;
use App\Observers\LikeObserver;
use Illuminate\Support\Facades\Event;
use App\Observers\UpdateVideoObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Like::observe(LikeObserver::class);
        Video::observe(UpdateVideoObserver::class);
    }
}
