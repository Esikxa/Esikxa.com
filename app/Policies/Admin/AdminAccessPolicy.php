<?php

namespace App\Policies\Admin;

use App\Helpers\AdminRolePermissionHelper;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminAccessPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function perform(User $user, $permission)
    {
        return AdminRolePermissionHelper::isGateSurpassed($permission);
    }
}
