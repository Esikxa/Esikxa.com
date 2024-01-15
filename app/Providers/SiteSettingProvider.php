<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SiteSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole() && count(Schema::getColumnListing('site_settings'))) {
            cache()->forget('settings');
            $settings = SiteSetting::get();
            $config = [];

            foreach ($settings as $key => $setting) {
                Config::set('settings.' . $setting->slug, $setting->value);
            }
        }
    }
}
