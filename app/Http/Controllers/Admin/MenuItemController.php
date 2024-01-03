<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantHelper;
use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Repositories\ContentRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    protected $menu, $menuItem,$content;
    public function __construct(
        MenuRepository $menu,
        MenuItemRepository $menuItem,
        ContentRepository $content
    ) {
        $this->menu = $menu;
        $this->menuItem = $menuItem;
        $this->content = $content;
    }

    public function index($id)
    {
        $menu = $this->menu->findByUuid($id);
        $customLinks = $this->menu->customLinks($id);
        $items = $this->menuItem->items($menu->id);
        $contents = $this->content->where('status', '=', 1)->orderBy('title', 'asc')->get();
        return view('admin.menuItem.index', compact('menu', 'customLinks', 'items', 'contents'));
    }
    public function edit($id, $itemId)
    {
        $menuItem = $this->menuItem->find($itemId);
        $menu = $this->menu->find($id);

        return view('admin.menuItem.edit', compact('menuItem', 'menu'));
    }
    public function store(Request $request, $id)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        $menu = $this->menu->findByUuid($id);
        $data['menu_id'] = $menu->id;

        if ($data['type'] == ConstantHelper::MENU_TYPE_CUSTOM) {
            // dd($data);
            $this->menuItem->create($data);
        } else {
            foreach ($data['model_ids'] as $key => $reference_id) {
                if (!$this->menuItem->where('menu_id', $data['menu_id'])->where('type', $data['type'])->where('reference_id', $reference_id)->first()) {
                    $menuItem = $this->menu->getContent($data['type'], $reference_id);
                    $url = '';
                    switch ($data['type']) {
                        case ConstantHelper::MENU_TYPE_CONTENT:
                            $url = '';
                            break;
                    }
                    $menuItemData['type'] = $data['type'];
                    $menuItemData['menu_id'] = $data['menu_id'];
                    $menuItemData['reference_id'] = $reference_id;
                    $menuItemData['title'] = isset($menuItem->title) ? $menuItem->title : '';
                    $menuItemData['slug'] = isset($menuItem->slug) ? $menuItem->slug : '';
                    $menuItemData['link_url'] = isset($menuItem->slug) ? $url . '/' . $menuItem->slug : '';
                    // dd($menuItemData);
                    $this->menuItem->model()->insert($menuItemData);
                }
            }
            return redirect()->route('admin.menu.menu-item.index', $id)->with('flash_notice', 'Menu item(s) created successfully.');
        }

        return redirect()->back()->withInput()->with('flash_notice', 'Menu can not be created.');
    }
    public function update(Request $request, $id, $itemId)
    {
        $data = $request->except(['_token', '_method']);
        $data['is_external'] = isset($request['is_external']) ? 1 : 0;
        $data['link_target'] = isset($request['link_target']) ? 1 : 0;
        $menu = $this->menu->findByUuid($id);

        if ($request->hasFile('image')) {
            $filelocation = MediaHelper::upload($request->file('image'), 'menu', false);
            $data['image'] = $filelocation['storage'];
        }
        $menuItem = $this->menuItem->updateById($itemId, $data);
        return redirect()->route('admin.menu.menu-item.index', $menu->uuid)
            ->with('flash_notice', 'Menu Item updated successfully');
    }
    public function destroy(Request $request, $menu_id, $id)
    {
        if ($this->menuItem->destroy($id)) {
            return response()->json(['status' => 'ok', 'message' => 'Menu deleted successfully.'], 200);
        }
        return response()->json(['status' => 'error', 'message' => ''], 422);
    }
    public function sort(Request $request, $id)
    {
        $list = $request->list;
        if (isset($list)) {
            foreach ($list as $lvl => $data1) {
                $item = $this->menuItem->updateById($data1['id'], ['display_order' => $lvl]);
                $this->updateUrl($item);
            }
            return 'success';
        }
    }
    protected function updateUrl($item)
    {
        $item->link_url = '';
        if ($item->type != ConstantHelper::MENU_TYPE_CUSTOM) {
            $url = $this->menu->content($item);
            $item->link_url = $url['relative_url'];
            $item->save();
        }
    }
}