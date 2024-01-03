<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GradeRequest;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    protected $subject;
    public function __construct(SubjectRepository $subject)
    {
        $this->subject = $subject;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'view-subject');

        $dataProvider = $this->subject->dataProvider($request);
        return view('admin.subject.index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-subject');
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        $this->authorize('admin-access-policy.perform', 'add-subject');

        try {
            DB::beginTransaction();
            $data = $request->except('_token,icon');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $data['popular'] = $request->has('popular') ? $request->popular : ConstantHelper::STATUS_INACTIVE;
            if ($request->hasFile('icon')) {
                $filelocation = MediaHelper::upload($request->file('icon'), 'grade');
                $data['icon'] = $filelocation['storage'];
            }
            $this->subject->create($data);
            DB::commit();
            return redirect()->route('admin.subject.index')->with('success', 'The record has been created successfully');
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
        $this->authorize('admin-access-policy.perform', 'edit-subject');

        $model = $this->subject->findByUuid($id);

        return view('admin.subject.edit', ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, string $id)
    {
        $this->authorize('admin-access-policy.perform', 'edit-subject');

        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['status'] = $request->has('status') ? $request->status : ConstantHelper::STATUS_INACTIVE;
            $data['popular'] = $request->has('popular') ? $request->popular : ConstantHelper::STATUS_INACTIVE;
            if ($request->hasFile('icon')) {
                $filelocation = MediaHelper::upload($request->file('icon'), 'grade');
                $data['icon'] = $filelocation['storage'];
            }
            $this->subject->update($id, $data);
            DB::commit();
            return redirect()->route('admin.subject.index')->with('success', 'The record has been updated successfully.');
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
        $this->authorize('admin-access-policy.perform', 'delete-subject');

        if (request()->ajax()) {
            $model = $this->subject->findByUuid($id);
            if ($model->delete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted successfully.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function trash(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'delete-subject');

        $request['trash'] = true;

        $dataProvider = $this->subject->dataProvider($request);

        return view('admin.subject.trash', ['dataProvider' => $dataProvider]);
    }

    public function restore(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = $this->subject->findByUuid($id);
            if ($model->restore()) {
                return response()->json(['status' => 0, 'message' => 'The data has been restored successfully.', 'data' => $model->status], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! data cannot be restored.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $this->authorize('admin-access-policy.perform', 'change-status-subject');

        if ($request->ajax()) {
            $model = $this->subject->findByUuid($id);
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
        $this->authorize('admin-access-policy.perform', 'delete-subject');

        if ($request->ajax()) {
            $model = $this->subject->findByUuid($id);
            if ($model->forceDelete()) {
                return response()->json(['status' => 0, 'message' => 'The record has been deleted permanently.'], 200);
            }
            return response()->json(['status' => 1, 'message' => 'Oops! record cannot be deleted.'], 200);
        }
        return response()->json(['status' => 1, 'message' => 'Oops! access denied.'], 200);
    }
}
