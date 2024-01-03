<?php

namespace App\Observers;

use App\Models\Content;
use Illuminate\Support\Str;

class ContentObserver
{
    /**
     * Handle the Content "creating" event.
     */
    public function creating(Content $content): void
    {
        $content->uuid = Str::uuid();
    }
    /**
     * Handle the Content "created" event.
     */
    public function created(Content $content): void
    {
        //
    }

    /**
     * Handle the Content "updated" event.
     */
    public function updated(Content $content): void
    {
        //
    }

    /**
     * Handle the Content "deleted" event.
     */
    public function deleted(Content $content): void
    {
        //
    }

    /**
     * Handle the Content "restored" event.
     */
    public function restored(Content $content): void
    {
        //
    }

    /**
     * Handle the Content "force deleted" event.
     */
    public function forceDeleted(Content $content): void
    {
        //
    }
}
