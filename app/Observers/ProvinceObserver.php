<?php

namespace App\Observers;

use App\Models\Province;
use Illuminate\Support\Str;

class ProvinceObserver
{
    /**
     * Handle the Province "creating" event.
     */
    public function creating(Province $province): void
    {
        $province->uuid = Str::uuid();
    }
    /**
     * Handle the Province "created" event.
     */
    public function created(Province $province): void
    {
        //
    }

    /**
     * Handle the Province "updated" event.
     */
    public function updated(Province $province): void
    {
        //
    }

    /**
     * Handle the Province "deleted" event.
     */
    public function deleted(Province $province): void
    {
        //
    }

    /**
     * Handle the Province "restored" event.
     */
    public function restored(Province $province): void
    {
        //
    }

    /**
     * Handle the Province "force deleted" event.
     */
    public function forceDeleted(Province $province): void
    {
        //
    }
}
