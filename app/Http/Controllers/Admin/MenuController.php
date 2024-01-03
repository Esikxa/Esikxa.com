<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-menu');

        $dataProvider = $this->menu->dataProvider($request);
        return view('admin.menu.index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin-access-policy.perform', 'add-menu');

        return view('admin.menu.create');
    }
    public function store(MenuRequest $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-menu');

        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $this->menu->create($data);
            DB::commit();
            return redirect()->route('admin.menu.index')->with('success', 'The record has been added successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Oops! record cannot be added.');
        }
    }
    public function edit($id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-menu');

        $model = $this->menu->findByUuid($id);
        return view('admin.menu.edit', ['model' => $model]);
    }

    public function update(MenuRequest $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-menu');

        $model = $this->menu->findByUuid($id);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;

            $this->menu->update($id, $data);
            DB::commit();
            return redirect()->route('admin.menu.index')->with('success', 'The record has been updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Oops! record cannot be added.');
        }
    }
    public function changeStatus(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'change-status-menu');

        if ($request->ajax()) {
            $model = $this->menu->findByUuid($id);
            $model->status = $model->status == ConstantHelper::STATUS_ACTIVE ? ConstantHelper::STATUS_INACTIVE : ConstantHelper::STATUS_ACTIVE;
            if ($model->save()) {
                return response()->json(['status' => 0, 'message' => 'The status has been updated successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! status cannot be updated.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'delete-menu');

        if ($request->ajax()) {
            $model = $this->menu->findByUuid($id);
            if ($model->delete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted successfully.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
}
