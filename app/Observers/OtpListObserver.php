<?php

namespace App\Observers;

use App\Models\OtpList;
use Illuminate\Support\Str;

class OtpListObserver
{
    /**
     * Handle the OtpList "creating" event.
     */
    public function creating(OtpList $otpList): void
    {
        $otpList->uuid = Str::uuid();
    }
    /**
     * Handle the OtpList "created" event.
     */
    public function created(OtpList $otpList): void
    {
        //
    }

    /**
     * Handle the OtpList "updated" event.
     */
    public function updated(OtpList $otpList): void
    {
        //
    }

    /**
     * Handle the OtpList "deleted" event.
     */
    public function deleted(OtpList $otpList): void
    {
        //
    }

    /**
     * Handle the OtpList "restored" event.
     */
    public function restored(OtpList $otpList): void
    {
        //
    }

    /**
     * Handle the OtpList "force deleted" event.
     */
    public function forceDeleted(OtpList $otpList): void
    {
        //
    }
}
