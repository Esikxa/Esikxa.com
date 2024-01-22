<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher, $role, $client;

    public function __construct(UserRepository $teacher, RoleRepository $role)
    {
        $this->teacher = $teacher;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->merge(['type' => ConstantHelper::USER_TYPE_TEACHER]);
        $dataProvider = $this->teacher->dataProvider($request);
        return view('admin.teacher.index', ['dataProvider' => $dataProvider]);
    }


    public function changeStatus(Request $request, $id)
    {

        if ($request->ajax()) {
            $model = $this->teacher->findByUuid($id);
            $model->status = $model->status == ConstantHelper::STATUS_ACTIVE ? ConstantHelper::STATUS_INACTIVE : ConstantHelper::STATUS_ACTIVE;
            if ($model->save()) {
                return response()->json(['status' => 0, 'message' => 'The status has been updated successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! status cannot be updated.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

}
