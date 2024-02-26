<?php

namespace App\Services\Subscriptions;

use App\Services\Subscriptions\Actions\ActivateSubscriptionAction;
use App\Services\Subscriptions\Actions\CancelSubscriptionAction;

class SubscriptionService
{
    public function activateSubscription(): ActivateSubscriptionAction
    {
        return new ActivateSubscriptionAction;
    }

    public function cancelSubscription(): CancelSubscriptionAction
    {
        return new CancelSubscriptionAction;
    }
}
