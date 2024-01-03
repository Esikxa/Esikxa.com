<?php

namespace App\Observers;

use App\Models\ModulePermission;
use Illuminate\Support\Str;

class ModulePermissionObserver
{
    /**
     * Handle the ModulePermission "creating" event.
     */
    public function creating(ModulePermission $modulePermission): void
    {
        $modulePermission->uuid = Str::uuid();
    }
    /**
     * Handle the ModulePermission "created" event.
     */
    public function created(ModulePermission $modulePermission): void
    {
        //
    }

    /**
     * Handle the ModulePermission "updated" event.
     */
    public function updated(ModulePermission $modulePermission): void
    {
        //
    }

    /**
     * Handle the ModulePermission "deleted" event.
     */
    public function deleted(ModulePermission $modulePermission): void
    {
        //
    }

    /**
     * Handle the ModulePermission "restored" event.
     */
    public function restored(ModulePermission $modulePermission): void
    {
        //
    }

    /**
     * Handle the ModulePermission "force deleted" event.
     */
    public function forceDeleted(ModulePermission $modulePermission): void
    {
        //
    }
}
