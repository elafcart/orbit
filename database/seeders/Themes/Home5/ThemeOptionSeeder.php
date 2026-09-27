<?php

namespace Database\Seeders\Themes\Home5;

class ThemeOptionSeeder extends \Database\Seeders\Themes\Main\ThemeOptionSeeder
{
    public function getThemeOptions(): array
    {
        return [
            ...parent::getThemeOptions(),
            // Home5's header card sits inside a light bg-neutral-50 page (header_homepage_light_text = false),
            // so the logo needs to be the dark-coloured cube (favicon-light.png). Main seeder defaults to
            // favicon-dark.png (light cube for Home1's dark hero).
            'logo' => $this->filePath('general/favicon-light.png'),
            'site_title' => 'Orisa — Personal Creative',
            'seo_description' => 'Orisa is a versatile Botble CMS theme tailored for personal creative portfolios and freelancers. Built on Bootstrap 5, it offers professional, responsive designs to suit diverse creative needs.',
            'primary_color' => '#F0460E',
            'tp_primary_font' => 'DM Sans',
            'copyright' => 'Orisa © %Y',
            'newsletter_popup_title' => 'Stay Updated with Orisa',
            'newsletter_popup_description' => "Join our newsletter and discover how Orisa's personal creative portfolio solution can transform your digital presence with modern, responsive design and powerful features.",
            'footer_background_image' => null,
            'footer_background_color' => '#374151',
            'header_style' => '3',
            'display_header_top' => false,
            'header_top_address' => '',
            'header_top_phone' => '',
            'header_top_email' => '',
            'hide_header_cart' => true,
            'header_cta_label' => '',
            'header_cta_url' => '',
            'header_layout' => 'full-width',
            'header_homepage_light_text' => false,
            'header_transparent' => false,
            'footer_style' => '5',
            'footer_brand_text' => 'Orisa Nova',
            'footer_connect_prefix' => "I'm",
        ];
    }
}
