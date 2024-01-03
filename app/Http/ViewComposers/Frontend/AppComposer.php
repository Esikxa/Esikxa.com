<?php

namespace App\Http\ViewComposers\Frontend;

use App\Helpers\LayoutHelper;
use App\Models\City;
use App\Repositories\MenuItemRepository;
use App\Repositories\MenuRepository;
use Illuminate\View\View;

class AppComposer
{
    protected $menu, $menuItem;

    public function __construct(
        MenuRepository $menu,
        MenuItemRepository $menuItem,
    ) {
        $this->menu = $menu;
        $this->menuItem = $menuItem;
    }

    public function compose(view $view)
    {
        $layoutMenu = LayoutHelper::layoutMenu();
        $menu = $this->menu->frontendMenu();
        $menuItems = [];
        $primaryMenu = LayoutHelper::primaryMenu($layoutMenu, 'primary-menu');
        if ($primaryMenu) {
            foreach ($menu as $data) {
                if ($data->menu_id == $primaryMenu) {
                    if ($data->parent_id == null) {
                        $menuItems['parent'][$data->id]['id'] = $data->id;
                        $menuItems['parent'][$data->id]['title'] = $data->title;
                        $menuItems['parent'][$data->id]['slug'] = $data->slug;
                        $menuItems['parent'][$data->id]['url'] = $data->is_external == 1 ? ($data->link_url) : url($data->link_url);
                        $menuItems['parent'][$data->id]['relative_url'] = $data->link_url;
                        $menuItems['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                        $menuItems['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                        $menuItems['parent'][$data->id]['image'] = $data->image != '' && file_exists('storage/' . $data->image) ? asset('storage/' . $data->image) : '';
                    } else {
                        $menuItems['child'][$data->parent_id][$data->id]['title'] =  $data->title;
                        $menuItems['child'][$data->parent_id][$data->id]['slug'] = $data->slug;
                        $menuItems['child'][$data->parent_id][$data->id]['url'] = $data->is_external == 1 ? ($data->link_url) : url($data->link_url);
                        $menuItems['child'][$data->parent_id][$data->id]['relative_url'] = $data->link_url;
                        $menuItems['child'][$data->parent_id][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                        $menuItems['child'][$data->parent_id][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                    }
                }
            }
        }
        // dd($menuItems);


        $widget1Items = [];
        $widget1 = LayoutHelper::widget1($layoutMenu, 'widget-1');
        if ($widget1) {
            foreach ($menu as $data) {
                if ($data->menu_id == $widget1 && $data->parent_id == null) {
                    $widget1Items['parent'][$data->id]['id'] = $data->id;
                    $widget1Items['parent'][$data->id]['title'] = $data->title;
                    $widget1Items['parent'][$data->id]['slug'] = $data->slug;
                    if (!empty($data->link_url)) {
                        $widget1Items['parent'][$data->id]['url'] = $data->is_external == 1 ? ($data->link_url) : url('/') . $data->link_url;
                    } else {
                        $widget1Items['parent'][$data->id]['url'] = '#';
                    }
                    $widget1Items['parent'][$data->id]['relative_url'] = $data->link_url;
                    $widget1Items['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $widget1Items['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                }
            }
        }

        $widget2Items = [];
        $widget2 = LayoutHelper::widget2($layoutMenu, 'widget-2');
        if ($widget2) {
            foreach ($menu as $data) {
                if ($data->menu_id == $widget2 && $data->parent_id == null) {
                    $widget2Items['parent'][$data->id]['id'] = $data->id;
                    $widget2Items['parent'][$data->id]['title'] = $data->title;
                    $widget2Items['parent'][$data->id]['slug'] = $data->slug;
                    if (!empty($data->link_url)) {
                        $widget2Items['parent'][$data->id]['url'] = $data->is_external == 1 ? ($data->link_url) : url('/') . $data->link_url;
                    } else {
                        $widget2Items['parent'][$data->id]['url'] = '#';
                    }
                    $widget2Items['parent'][$data->id]['relative_url'] = $data->link_url;
                    $widget2Items['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $widget2Items['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                }
            }
        }

        $widget3Items = [];
        $widget3 = LayoutHelper::widget3($layoutMenu, 'widget-3');
        if ($widget3) {
            foreach ($menu as $data) {
                if ($data->menu_id == $widget3 && $data->parent_id == null) {
                    $widget3Items['parent'][$data->id]['id'] = $data->id;
                    $widget3Items['parent'][$data->id]['title'] = $data->title;
                    $widget3Items['parent'][$data->id]['slug'] = $data->slug;
                    $widget3Items['parent'][$data->id]['url'] = $data->is_external == 1 ? ($data->link_url) : url($data->link_url);
                    $widget3Items['parent'][$data->id]['relative_url'] = $data->link_url;
                    $widget3Items['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $widget3Items['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                }
            }
        }
        $view->withMenuItems($menuItems)
            ->withWidget1($widget1Items)
            ->withWidget2($widget2Items)
            ->withWidget3($widget3Items);
    }
}
