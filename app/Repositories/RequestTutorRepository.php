<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\RequestTutor;

class RequestTutorRepository extends Repository
{
    protected $model;

    public function __construct(RequestTutor $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;
        $orderBy = $request->has('order_by') ? $request->order_by : 'id';
        $sort = $request->has('sort') ? $request->sort : 'desc';

        $dataProvider = $this->model;


        if ($request->has('name') && $request->filled('name')) {
            $dataProvider = $dataProvider->where('first_name', 'like', "%{$request?->name}%");
            $dataProvider = $dataProvider->orWhere('middle_name', 'like', "%{$request?->name}%");
            $dataProvider = $dataProvider->orWhere('last_name', 'like', "%{$request?->name}%");
        }

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
