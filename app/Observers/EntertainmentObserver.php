<?php

namespace App\Observers;

use App\Models\Entertainment;
use Illuminate\Support\Facades\Storage;

class EntertainmentObserver
{
    /**
     * Handle the Entertainment "created" event.
     */
    public function created(Entertainment $entertainment): void
    {
        //
    }

    /**
     * Handle the Entertainment "updated" event.
     */
    public function updated(Entertainment $entertainment): void
    {
        //
    }

    /**
     * Handle the Entertainment "deleted" event.
     */
    public function deleted(Entertainment $entertainment): void
    {
        //
    }

    public function deleting(Entertainment $entertainment): void
    {
        if ($entertainment->isForceDeleting()) {
            foreach ($entertainment->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
        }
    }

    /**
     * Handle the Entertainment "restored" event.
     */
    public function restored(Entertainment $entertainment): void
    {
        //
    }

    /**
     * Handle the Entertainment "force deleted" event.
     */
    public function forceDeleted(Entertainment $entertainment): void
    {
        //
    }
}
