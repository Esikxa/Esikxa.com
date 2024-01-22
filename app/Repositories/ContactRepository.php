<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\Contact;

class ContactRepository extends Repository
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;
        $orderBy = $request->has('order_by') ? $request->order_by : 'id';
        $sort = $request->has('sort') ? $request->sort : 'desc';

        $dataProvider = $this->model;


        if ($request->has('keyword') && $request->filled('keyword')) {
            $dataProvider = $dataProvider->where('full_name', 'like', "%{$request?->keyword}%");
            $dataProvider = $dataProvider->orWhere('email', 'like', "%{$request?->keyword}%");
            $dataProvider = $dataProvider->orWhere('message', 'like', "%{$request?->keyword}%");
            $dataProvider = $dataProvider->orWhere('contact', 'like', "%{$request?->keyword}%");
            $dataProvider = $dataProvider->orWhere('subject', 'like', "%{$request?->keyword}%");
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
