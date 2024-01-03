<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\Models\RolePermission;
use App\Repositories\ModuleRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    protected $role, $user, $module;
    public function __construct(RoleRepository $role, UserRepository $user, ModuleRepository $module)
    {
        $this->role = $role;
        $this->user = $user;
        $this->module = $module;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-role');

        $roles = $this->role->dataProvider($request, false);
        $modules = $this->module->dataProvider($request, false);
        return view('admin.role.index', ['roles' => $roles, 'modules' => $modules]);
    }
    public function getAdminUser(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-user');

        $request->type = '1';

        $users = $this->user->dataProvider($request, false);
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                "id" =>  $user->id,
                "full_name" => $user->full_name,
                "role" =>  $user->role->title,
                "username" =>  $user->username,
                "email" =>  $user->email,
                "status" =>  $user->status,
                "avatar" =>  $user->avatar
            ];
        }
        return response()->json(["data" => $data]);
    }
    public function getPermisison($uuid)
    {
        $role = $this->role->findByUuid($uuid);
        $permissions = [];
        if ($role) {
            $permissions = $role->permissions->pluck('uuid')->toArray();
        }
        return response()->json($permissions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-role');
        $modules = $this->module->dataProvider($request, false);
        return view('admin.role.create', ['modules' => $modules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {

        $this->authorize('admin-access-policy.perform', 'add-role');
        try {
            DB::beginTransaction();
            $data = $request->only('title', 'status');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $role = $this->role->create($data);
            if ($request->permissions && is_array($request->permissions) && !empty($request->permissions)) {
                foreach ($request->permissions as $permission) {
                    $data  = RolePermission::create([
                        'role_id' => $role->id,
                        'permission_id' => $permission
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Role Created Successfully');
        } catch (\Throwable $th) {
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
        $this->authorize('admin-access-policy.perform', 'edit-role');
        $model = $this->role->findByUuid($id);
        $permissions = $model->permissions->pluck('id')->toArray();
        $modules = $this->module->dataProvider($request, false);
        return view('admin.role.edit', ['modules' => $modules, 'model' => $model, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-role');

        try {
            DB::beginTransaction();
            $role = $this->role->findByUuid($id);
            if (!$role) {
                abort(404);
            }
            $data = $request->only('title', 'status');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $this->role->update($id, $data);
            RolePermission::where('role_id', $role->id)->delete();
            if ($request->permissions && is_array($request->permissions) && !empty($request->permissions)) {
                foreach ($request->permissions as $permission) {
                    $data  = RolePermission::create([
                        'role_id' => $role->id,
                        'permission_id' => $permission
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Role Updated Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort(404);
    }
}
