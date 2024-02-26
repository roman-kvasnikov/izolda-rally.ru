<?php

namespace App\Services\Subscriptions\Listeners;

use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Subscriptions\Models\Subscription;
use App\Services\Subscriptions\SubscriptionService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateSubscriptionListener implements ShouldQueue
{
    public function __construct(
        private SubscriptionService $subscriptionService
    ) {
    }

    public function handle(
        PaymentCompletedEvent $event
    ): void {
        $payableType = $event->data->payableType;
        $payableId = $event->data->payableId;

        if ($payableType !== (new Subscription)->getPayableType()) {
            return;
        }

        if ($subscription = Subscription::query()->find($payableId)) {
            $this->subscriptionService->activateSubscription()->run($subscription);
        }
    }
}
