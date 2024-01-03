<?php

namespace App\Repositories;

use App\Models\Province;

class ProvinceRepository extends Repository
{
    protected $model;

    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}
