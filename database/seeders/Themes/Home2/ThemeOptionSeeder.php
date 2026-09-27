<?php

namespace Database\Seeders\Themes\Home2;

class ThemeOptionSeeder extends \Database\Seeders\Themes\Main\ThemeOptionSeeder
{
    public function getThemeOptions(): array
    {
        return [
            ...parent::getThemeOptions(),
            // Home2's hero uses dark text on a light background (header_homepage_light_text = false),
            // so the logo needs to be the dark-coloured cube (favicon-light.png). Main seeder
            // defaults to favicon-dark.png (light cube for Home1's dark hero).
            'logo' => $this->filePath('general/favicon-light.png'),
            'site_title' => 'Orisa — Digital Agency',
            'seo_description' => 'Orisa is a versatile Botble CMS theme tailored for digital agencies and creative studios. Built on Bootstrap 5, it offers professional, responsive designs to suit diverse business needs.',
            'primary_color' => '#F0460E',
            'tp_primary_font' => 'DM Sans',
            'copyright' => 'Copyright © %Y Orisa. All Rights Reserved',
            'newsletter_popup_title' => 'Stay Updated with Orisa',
            'newsletter_popup_description' => "Join our newsletter and discover how Orisa's multipurpose digital agency solution can transform your digital presence with modern, responsive design and powerful features.",
            'header_layout' => 'full-width',
            'header_homepage_light_text' => false,
            'footer_style' => '2',
            'footer_connect_title' => "Let's Connect",
            'footer_hours_label' => 'Mo - Sa',
            'footer_hours_value' => '9am - 5pm',
        ];
    }
}
