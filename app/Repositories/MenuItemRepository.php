<?php


namespace App\Repositories;

use App\Models\MenuItem;

class MenuItemRepository extends Repository
{
    protected  $preferredLanguage;

    public function __construct(MenuItem $menuItem)
    {
        $this->model =  $menuItem;
    }
    public function items($id)
    {
        $items = $this->model->where('menu_id', $id)->orderBy('display_order', 'asc')->get();
        $response = [];
        if ($items) {
            foreach ($items as $data) {
                if ($data->parent_id == null) {
                    $response['parent'][$data->id]['id'] = $data->id;
                    $response['parent'][$data->id]['type'] = $data->type;
                    $response['parent'][$data->id]['title'] = $data->title;
                    $response['parent'][$data->id]['slug'] = $data->slug;
                    $response['parent'][$data->id]['url'] = url($data->link_url);
                    $response['parent'][$data->id]['relative_url'] = $data->link_url;
                    $response['parent'][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $response['parent'][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                } else {
                    $response['child'][$data->parent_id][$data->id]['id'] = $data->id;
                    $response['child'][$data->parent_id][$data->id]['type'] = $data->type;
                    $response['child'][$data->parent_id][$data->id]['title'] =  $data->title;
                    $response['child'][$data->parent_id][$data->id]['slug'] = $data->slug;
                    $response['child'][$data->parent_id][$data->id]['url'] = url($data->link_url);
                    $response['child'][$data->parent_id][$data->id]['relative_url'] = $data->link_url;
                    $response['child'][$data->parent_id][$data->id]['target'] = $data->link_target == true ? 'target="_blank"' : '';
                    $response['child'][$data->parent_id][$data->id]['icon'] = isset($data->icon) && !empty($data->icon) ? $data->icon : '';
                }
            }
        }
        return $response;
    }
}