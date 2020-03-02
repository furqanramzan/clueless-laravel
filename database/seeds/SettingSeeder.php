<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->setting->create([
        //     'key' => 'contact_us',
        //     'name' => 'Contact Us Page',
        //     'value' => ''
        // ]);
        $this->setting->create([
            'key' => 'footer',
            'name' => 'Edit Footer Content',
            'value' => ''
        ]);
    }
}
