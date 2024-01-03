<?php

namespace App\Observers;

use App\Models\Menu;
use Illuminate\Support\Str;

class MenuObserver
{
    /**
     * Handle the Menu "creating" event.
     */
    public function creating(Menu $menu): void
    {
        $menu->uuid = Str::uuid();
    }
    /**
     * Handle the Menu "created" event.
     */
    public function created(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "updated" event.
     */
    public function updated(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "deleted" event.
     */
    public function deleted(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "restored" event.
     */
    public function restored(Menu $menu): void
    {
        //
    }

    /**
     * Handle the Menu "force deleted" event.
     */
    public function forceDeleted(Menu $menu): void
    {
        //
    }
}
