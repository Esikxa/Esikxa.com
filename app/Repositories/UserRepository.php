<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\User;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;
        $orderBy = $request->has('order_by') ? $request->order_by : 'first_name';
        $sort = $request->has('sort') ? $request->sort : 'asc';

        $dataProvider = $this->model;


        if ($request->has('name') && $request->filled('name')) {
            $dataProvider = $dataProvider->where('first_name', 'like', "%{$request?->name}%");
            $dataProvider = $dataProvider->orWhere('middle_name', 'like', "%{$request?->name}%");
            $dataProvider = $dataProvider->orWhere('last_name', 'like', "%{$request?->name}%");
        }
        if ($request->has('mobile') && $request->filled('mobile')) {
            $dataProvider = $dataProvider->where('mobile', $request?->mobile);
        }
        if ($request->has('email') && $request->filled('email')) {
            $dataProvider = $dataProvider->where('email', $request?->email);
        }
        if ($request->has('status') && $request->filled('status')) {
            $dataProvider = $dataProvider->where('status', $request?->status);
        }
        if ($request->has('type') && $request->filled('type')) {
            $dataProvider = $dataProvider->where('type', $request?->type);
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
