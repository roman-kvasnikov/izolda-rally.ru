<?php

namespace App\Services\Subscriptions;

use App\Services\Payments\Events\PaymentCancelledEvent;
use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Subscriptions\Listeners\ActivateSubscriptionListener;
use App\Services\Subscriptions\Listeners\CancelSubscriptionListener;
use App\Services\Subscriptions\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'subscription' => Subscription::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/Migrations');
        }

        Event::listen(PaymentCompletedEvent::class, ActivateSubscriptionListener::class);
        Event::listen(PaymentCancelledEvent::class, CancelSubscriptionListener::class);
    }
}
