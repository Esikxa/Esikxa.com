<?php

namespace App\Observers;

use App\Helpers\ConstantHelper;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Support\Str;

class RoleObserver
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
    /**
     * Handle the Role "creating" event.
     */
    public function creating(Role $role): void
    {
        $role->uuid = Str::uuid();
        $role->code = $this->code();
    }
    /**
     * Handle the Role "created" event.
     */
    public function created(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "updated" event.
     */
    public function updated(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "deleted" event.
     */
    public function deleted(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "restored" event.
     */
    public function restored(Role $role): void
    {
        //
    }

    /**
     * Handle the Role "force deleted" event.
     */
    public function forceDeleted(Role $role): void
    {
        //
    }

    protected function code()
    {
        $count = $this->role->withTrashed()->count();
        $count += 1;
        $count = str_pad($count, 5, 0, STR_PAD_LEFT);
        return ConstantHelper::ROLE_CODE_PREFIX . $count;
    }
}
