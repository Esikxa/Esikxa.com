<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\Subject;

class SubjectRepository extends Repository
{
    protected $model;

    public function __construct(Subject $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;
        $orderBy = $request->has('order_by') ? $request->order_by : 'id';
        $sort = $request->has('sort') ? $request->sort : 'asc';

        $dataProvider = $this->model;
        if ($request->trash == true) {
            $dataProvider = $dataProvider->onlyTrashed();
        }
        if ($request->has('status')) {
            $dataProvider = $dataProvider->where('status', $request->status);
        }
        if ($request->has('popular')) {
            $dataProvider = $dataProvider->where('popular', $request->popular);
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