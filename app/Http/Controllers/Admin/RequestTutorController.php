<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestTutor;
use App\Repositories\RequestTutorRepository;
use Illuminate\Http\Request;

class RequestTutorController extends Controller
{
    protected $requestTutor;
    public function __construct(RequestTutorRepository $requestTutor)
    {
        $this->requestTutor = $requestTutor;
    }

    public function index(Request $request)
    {
        $dataProvider = $this->requestTutor->dataProvider($request);
        return view('admin.request-tutor.index', ['dataProvider' => $dataProvider]);
    }
    public function changeStatus(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = $this->requestTutor->findByUuid($id);
            $model->status = $request->status;
            if ($model->save()) {
                return response()->json(['status' => 0, 'message' => 'The status has been updated successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! status cannot be updated.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
}
