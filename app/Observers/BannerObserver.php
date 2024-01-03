<?php

namespace App\Observers;

use App\Models\Banner;
use Illuminate\Support\Str;

class BannerObserver
{
    /**
     * Handle the Banner "creating" event.
     */
    public function creating(Banner $banner): void
    {
        $banner->uuid = Str::uuid();
    }
    /**
     * Handle the Banner "created" event.
     */
    public function created(Banner $banner): void
    {
        //
    }

    /**
     * Handle the Banner "updated" event.
     */
    public function updated(Banner $banner): void
    {
        //
    }

    /**
     * Handle the Banner "deleted" event.
     */
    public function deleted(Banner $banner): void
    {
        //
    }

    /**
     * Handle the Banner "restored" event.
     */
    public function restored(Banner $banner): void
    {
        //
    }

    /**
     * Handle the Banner "force deleted" event.
     */
    public function forceDeleted(Banner $banner): void
    {
        //
    }
}
