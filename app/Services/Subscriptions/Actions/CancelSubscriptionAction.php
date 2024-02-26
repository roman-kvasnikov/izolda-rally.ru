<?php

namespace App\Services\Subscriptions\Actions;

use App\Services\Subscriptions\Enums\SubscriptionStatusEnum;
use App\Services\Subscriptions\Models\Subscription;

class CancelSubscriptionAction
{
    public function run(Subscription $subscription): void
    {
        $subscription->update(['status' => SubscriptionStatusEnum::cancelled]);
    }
}
