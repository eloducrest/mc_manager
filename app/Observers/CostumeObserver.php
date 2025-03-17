<?php

namespace App\Observers;

use App\Models\Costume;

class CostumeObserver
{
    /**
     * Handle the Costume "created" event.
     */
    public function created(Costume $costume): void
    {
        //dd('oooooob', $costume);
    }

    /**
     * Handle the Costume "updated" event.
     */
    public function updated(Costume $costume): void
    {
        //
    }

    /**
     * Handle the Costume "deleted" event.
     */
    public function deleted(Costume $costume): void
    {
        //
    }

    /**
     * Handle the Costume "restored" event.
     */
    public function restored(Costume $costume): void
    {
        //
    }

    /**
     * Handle the Costume "force deleted" event.
     */
    public function forceDeleted(Costume $costume): void
    {
        //
    }
}
