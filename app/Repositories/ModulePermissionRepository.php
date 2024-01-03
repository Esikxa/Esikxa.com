<?php

namespace App\Repositories;

use App\Models\ModulePermission;

class ModulePermissionRepository extends Repository
{
    protected $model;

    public function __construct(ModulePermission $model)
    {
        $this->model = $model;
    }
}
