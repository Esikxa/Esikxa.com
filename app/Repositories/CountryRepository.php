<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository extends Repository
{
    protected $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
    }
}
