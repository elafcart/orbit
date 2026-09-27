<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Models\Page;
use Botble\Setting\Facades\Setting;

class SettingSeeder extends BaseSeeder
{
    public function run(): void
    {
        $homepageId = Page::query()->where('name', 'Homepage')->value('id');

        $settings = [
            'admin_logo' => $this->filePath('general/logo-white.png'),
            'admin_favicon' => $this->filePath('general/favicon.webp'),
            'show_on_front' => $homepageId,
        ];

        Setting::set($settings);
        Setting::save();
    }
}
