<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Services\AccessService;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function __construct(private AccessService $accessService) {
    }

    public function saved(Subscription $subscription): void
    {
        if(count(array_filter(request()->access))){
            $this->accessService->syncSubscriptionAccesses($subscription, request()->access);
        }
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
