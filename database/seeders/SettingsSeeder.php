<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'app_name',
                'value' => 'Laravel Dashboard',
            ],
            [
                'key' => 'app_logo',
                'value' => null,
            ],
            [
                'key' => 'sidebar_color',
                'value' => '#343a40',
            ],
            [
                'key' => 'dark_mode',
                'value' => '0',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}