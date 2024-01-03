<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\BannerRepository;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    protected $banner;
    public function __construct(BannerRepository $banner)
    {
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-banner');

        $dataProvider = $this->banner->dataProvider($request);
        return view('admin.banner.index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-banner');
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-banner');

        try {
            DB::beginTransaction();
            $data = $request->except('_token,image');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $data['show_title'] = $request->has('show_title') ? $request->show_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_description'] = $request->has('show_description') ? $request->show_description : ConstantHelper::STATUS_INACTIVE;
            $data['show_prefix_title'] = $request->has('show_prefix_title') ? $request->show_prefix_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_suffix_title'] = $request->has('show_suffix_title') ? $request->show_suffix_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_button'] = $request->has('show_button') ? $request->show_button : ConstantHelper::STATUS_INACTIVE;
            $data['target'] = $request->has('target') ? $request->target : ConstantHelper::STATUS_INACTIVE;

            if ($request->hasFile('image')) {
                $filelocation = MediaHelper::upload($request->file('image'), 'banner');
                $data['image'] = $filelocation['storage'];
            }
            $this->banner->create($data);
            DB::commit();
            return redirect()->route('admin.banner.index')->with('success', 'The record has been created successfully');
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
        $this->authorize('admin-access-policy.perform', 'edit-banner');

        $model = $this->banner->findByUuid($id);

        return view('admin.banner.edit', ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, string $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-banner');

        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $data['show_title'] = $request->has('show_title') ? $request->show_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_description'] = $request->has('show_description') ? $request->show_description : ConstantHelper::STATUS_INACTIVE;
            $data['show_prefix_title'] = $request->has('show_prefix_title') ? $request->show_prefix_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_suffix_title'] = $request->has('show_suffix_title') ? $request->show_suffix_title : ConstantHelper::STATUS_INACTIVE;
            $data['show_button'] = $request->has('show_button') ? $request->show_button : ConstantHelper::STATUS_INACTIVE;
            $data['target'] = $request->has('target') ? $request->target : ConstantHelper::STATUS_INACTIVE;
            if ($request->hasFile('image')) {
                $filelocation = MediaHelper::upload($request->file('image'), 'banner');
                $data['image'] = $filelocation['storage'];
            }
            $this->banner->update($id, $data);
            DB::commit();
            return redirect()->route('admin.banner.index')->with('success', 'The record has been updated successfully.');
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
        $this->authorize('admin-access-policy.perform', 'delete-banner');

        if (request()->ajax()) {
            $model = $this->banner->findByUuid($id);
            if ($model->delete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted successfully.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function trash(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'delete-banner');

        $request['trash'] = true;

        $dataProvider = $this->banner->dataProvider($request);

        return view('admin.banner.trash', ['dataProvider' => $dataProvider]);
    }

    public function restore(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = $this->banner->findByUuid($id);
            if ($model->restore()) {
                return response()->json(['status' => 0, 'message' => 'The data has been restored successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! data cannot be restored.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'change-status-banner');

        if ($request->ajax()) {
            $model = $this->banner->findByUuid($id);
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
        $this->authorize('admin-access-policy.perform', 'delete-banner');

        if ($request->ajax()) {
            $model = $this->banner->findByUuid($id);
            if ($model->forceDelete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted permanently.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
}
