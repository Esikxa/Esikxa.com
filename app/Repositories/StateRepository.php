<?php

namespace App\Repositories;

use App\Models\State;

class StateRepository extends Repository
{
    protected $model;

    public function __construct(State $model)
    {
        $this->model = $model;
    }
}
