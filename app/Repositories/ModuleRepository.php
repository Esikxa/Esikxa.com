<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\Module;

class ModuleRepository extends Repository
{
    protected $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;
        $orderBy = $request->has('order_by') ? $request->order_by : 'title';
        $sort = $request->has('sort') ? $request->sort : 'asc';

        $dataProvider = $this->model;
        if ($request->trash == true) {
            $dataProvider = $dataProvider->onlyTrashed();
        }
        $dataProvider = $dataProvider->orderBy($orderBy, $sort);
        if ($paginate) {
            $dataProvider = $dataProvider->paginate($limit);
        } else {
            $dataProvider = $dataProvider->get();
        }
        return $dataProvider;
    }
}
