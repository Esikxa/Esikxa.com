<?php

namespace App\Repositories;

use App\Helpers\ConstantHelper;
use App\Models\Content;

class ContentRepository extends Repository
{
    protected $model;

    public function __construct(Content $model)
    {
        $this->model = $model;
    }

    public function dataProvider($request, $paginate = true)
    {
        $limit = ConstantHelper::DEFAULT_PAGE_LIMIT;

        $dataProvider = $this->model;
        if ($request->trash == true) {
            $dataProvider = $dataProvider->onlyTrashed();
        }
        if ($request->has('title') && $request->title != '') {
            $dataProvider = $dataProvider->where('title', 'like', $request->title . '%');
        }

        if ($request->has('status') || $request->status != '') {
            $dataProvider = $dataProvider->where('status', $request->status);
        }
        if ($paginate) {
            $dataProvider = $dataProvider->paginate($limit);
        } else {
            $dataProvider = $dataProvider->get();
        }
        return $dataProvider;
    }
}