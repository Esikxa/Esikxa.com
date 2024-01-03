<?php

namespace App\Repositories;

use App\Models\UserRole;

class UserRoleRepository extends Repository
{
    protected $model;

    public function __construct(UserRole $model)
    {
        $this->model = $model;
    }
}
