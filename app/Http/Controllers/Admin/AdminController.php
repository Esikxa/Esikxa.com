<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\UserRole;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $user, $role;
    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-admin');
        $request['type'] = 1;
        $dataProvider = $this->user->dataProvider($request);
        return view('admin.admin.index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-admin');

        $roles = $this->role->get();
        return view('admin.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-admin');
        try {
            DB::beginTransaction();
            $data = $request->except('_token', 'role', 'password', 'confirmation_password');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $data['password'] = Hash::make($request->password);
            $data['username'] = $request->email;
            $data['type'] = ConstantHelper::USER_TYPE_ADMIN;
            $user = $this->user->create($data);
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('admin.admin.index')->with('success', 'The record has been created successfully');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-admin');

        $model = $this->user->findByUuid($id);
        $roles = $this->role->get();
        return view('admin.admin.edit', ['model' => $model, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, string $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-admin');
        try {
            DB::beginTransaction();
            $model = $this->user->findByUuid($id);
            $data = $request->except('_token', 'password', 'confirmation_password', 'role');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }
            $this->user->update($id, $data);
            DB::table('user_roles')->where('user_id', $model->id)->delete();
            UserRole::create([
                'user_id' => $model->id,
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('admin.admin.index')->with('success', 'The record has been updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Oops! record cannot be added.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('admin-access-policy.perform', 'delete-admin');

        if (request()->ajax()) {
            $model = $this->user->findByUuid($id);
            if ($model->delete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted successfully.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function trash(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'delete-admin');

        $request['trash'] = true;
        $request['type'] = 1;
        $dataProvider = $this->user->dataProvider($request);

        return view('admin.admin.trash', ['dataProvider' => $dataProvider]);
    }

    public function restore(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = $this->user->findByUuid($id);
            if ($model->restore()) {
                return response()->json(['status' => 0, 'message' => 'The data has been restored successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! data cannot be restored.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'change-status-admin');

        if ($request->ajax()) {
            $model = $this->user->findByUuid($id);
            $model->status = $model->status == ConstantHelper::STATUS_ACTIVE ? ConstantHelper::STATUS_INACTIVE : ConstantHelper::STATUS_ACTIVE;
            if ($model->save()) {
                return response()->json(['status' => 0, 'message' => 'The status has been updated successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! status cannot be updated.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
    public function forceDelete(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'delete-admin');

        if ($request->ajax()) {
            $model = $this->user->findByUuid($id);
            if ($model->forceDelete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted permanently.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
}
