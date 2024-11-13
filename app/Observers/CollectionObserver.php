<?php

namespace App\Observers;

use App\Models\Collection;

class CollectionObserver
{
    /**
     * Handle the Collection "created" event.
     */
    public function saved(Collection $collection) : void
    {
        if(!request()->lessons){
            return;
        }

        $lessons = array_filter(request()->lessons);
        $collection->lessons()->sync($lessons);
    }

    public function created(Collection $collection) : void
    {
        //
    }

    /**
     * Handle the Collection "updated" event.
     */
    public function updated(Collection $collection) : void
    {
        //
    }

    /**
     * Handle the Collection "deleted" event.
     */
    public function deleted(Collection $collection) : void
    {
        //
    }

    /**
     * Handle the Collection "restored" event.
     */
    public function restored(Collection $collection) : void
    {
        //
    }

    /**
     * Handle the Collection "force deleted" event.
     */
    public function forceDeleted(Collection $collection) : void
    {
        //
    }
}
