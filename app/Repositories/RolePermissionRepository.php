<?php

namespace App\Repositories;

use App\Models\RolePermission;

class RolePermissionRepository extends Repository
{
    protected $model;

    public function __construct(RolePermission $model)
    {
        $this->model = $model;
    }
}
