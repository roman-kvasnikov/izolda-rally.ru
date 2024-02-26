<?php

namespace App\Services\Subscriptions\Listeners;

use App\Services\Payments\Events\PaymentCancelledEvent;
use App\Services\Subscriptions\Models\Subscription;
use App\Services\Subscriptions\SubscriptionService;

class CancelSubscriptionListener
{
    public function __construct(
        private SubscriptionService $subscriptionService
    ) {
    }

    public function handle(
        PaymentCancelledEvent $event
    ): void {
        $payableType = $event->data->payableType;
        $payableId = $event->data->payableId;

        if ($payableType !== (new Subscription)->getPayableType()) {
            return;
        }

        if ($subscription = Subscription::query()->find($payableId)) {
            $this->subscriptionService->cancelSubscription()->run($subscription);
        }
    }
}
