<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ApiLogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected $apiLog;

    public function __construct(ApiLogRepository $apiLog)
    {
        $this->apiLog = $apiLog;
    }

    /**
     * Display a listing of the resource.
     */
    public function apiIndex(Request $request)
    {
        $dataProvider = $this->apiLog->dataProvider($request);

        return view('admin.log.api-log', ['dataProvider' => $dataProvider]);
    }
}
