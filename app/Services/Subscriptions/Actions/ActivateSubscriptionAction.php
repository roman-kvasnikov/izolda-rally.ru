<?php

namespace App\Services\Subscriptions\Actions;

use App\Services\Subscriptions\Enums\SubscriptionStatusEnum;
use App\Services\Subscriptions\Models\Subscription;

class ActivateSubscriptionAction
{
    public function run(Subscription $subscription): void
    {
        $subscription->update(['status' => SubscriptionStatusEnum::active]);
    }
}
