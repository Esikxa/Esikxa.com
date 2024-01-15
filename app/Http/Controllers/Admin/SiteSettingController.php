<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{

    public function index(Request $request)
    {
        $settings = SiteSetting::pluck('value', 'slug')->toArray();

        return view('admin.site-setting.index', compact('settings'));
    }
    public function store(Request $request)
    {
        $this->authorize('admin-access-policy.perform', 'edit-site-setting');


        try {
            DB::beginTransaction();

            foreach ($request->settings as $setting) {
                $value = $setting['value'] ?? '';
                if ($setting['form-type'] == 'file' && isset($setting['value'])) {
                    $filelocation = MediaHelper::upload($setting['value'], 'site-settings');
                    $value = $filelocation['storage'];
                }
                
                SiteSetting::updateOrCreate([
                    'slug' => $setting['slug'],

                ], [
                    'type' => $setting['type'],
                    'title' => $setting['title'],
                    'slug' => $setting['slug'],
                    'value' => $value,
                ]);
            }

            DB::commit();
            return redirect()->route('admin.site-setting.index')->with('success', 'The record has been updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return redirect()->back()->with('error', 'Oops! record cannot be added.');
        }
    }
}
