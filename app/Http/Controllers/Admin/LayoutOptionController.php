<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\LayoutOptionRepository;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayoutOptionController extends Controller
{
    protected $menu, $layoutOption;
    public function __construct(LayoutOptionRepository $layoutOption, MenuRepository $menu)
    {
        $this->menu = $menu;
        $this->layoutOption = $layoutOption;
    }

    public function index(Request $request)
    {
        $request['status'] = true;
        $menus = $this->menu->dataProvider($request, false);
        $options = $this->layoutOption->get();

        return view('admin.layout-option.index', compact('options', 'menus'));
    }
    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method', 'submitButton', 'blocks']);
        $blocks = $request->get('blocks');

        try {
            DB::beginTransaction();
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $this->layoutOption->updateById($key, ['menu_id' => $value]);
                }
            }
            if (is_array($blocks)) {
                foreach ($blocks as $key => $block) {
                    $this->layoutOption->updateById($key, ['value' => $block]);
                }
            }

            DB::commit();
            return redirect()->route('admin.layout-option.index')->with('success', 'The record has been updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Oops! record cannot be added.');
        }
    }
}
