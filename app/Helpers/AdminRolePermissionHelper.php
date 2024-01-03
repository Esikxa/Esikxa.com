<?php

namespace App\Helpers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class AdminRolePermissionHelper
{
    public static function loadPermission()
    {
        $permissions = [];
        if (Auth::check('admin')) {
            $permissions = (auth('admin')->user()->role->permissions)->pluck('slug')->toArray();
        }
        return $permissions;
        // session()->put('permissions', $permissions);
    }
    public static function isGateSurpassed($permission)
    {
        $permissions = AdminRolePermissionHelper::loadPermission();

        try {
            if (is_array($permission) && !empty(array_intersect($permission, $permissions)))
                return true;
            elseif (!is_array($permission) && in_array($permission, $permissions)) {
                return true;
            } else
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
