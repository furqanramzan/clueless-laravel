<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // only use the Settings if the Settings table is present in the database
        if (!\App::runningInConsole()) {
            // get all settings from the database and cache it
            $settings = cache()->rememberForever('settings', function () {
                return Setting::select('key', 'value')->get();
            });

            // bind all settings to the Laravel config, so we can call them like
            // config('settings.contact_email')
            foreach ($settings as $key => $setting) {
                config()->set('settings.'.$setting->key, $setting->value);
            }
        }
    }
}
