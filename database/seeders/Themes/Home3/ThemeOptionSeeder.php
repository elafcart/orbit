<?php

namespace Database\Seeders\Themes\Home3;

class ThemeOptionSeeder extends \Database\Seeders\Themes\Main\ThemeOptionSeeder
{
    public function getThemeOptions(): array
    {
        return [
            ...parent::getThemeOptions(),
            // Home3's header sits on a light background, so use the dark-coloured logo variant
            // (favicon-light.png — the dark cube). Main seeder defaults to favicon-dark.png (light cube for dark hero).
            'logo' => $this->filePath('general/favicon-light.png'),
            'site_title' => 'Orisa — Marketing Agency',
            'seo_description' => 'Orisa is a versatile Botble CMS theme tailored for marketing agencies and creative studios. Built on Bootstrap 5, it offers professional, responsive designs to suit diverse business needs.',
            'primary_color' => '#F0460E',
            'tp_primary_font' => 'DM Sans',
            'copyright' => 'Orisa © %Y',
            'newsletter_popup_title' => 'Stay Updated with Orisa',
            'newsletter_popup_description' => "Join our newsletter and discover how Orisa's multipurpose marketing agency solution can transform your digital presence with modern, responsive design and powerful features.",
            'header_layout' => 'container',
            'display_header_top' => true,
            // Home3 header matches index-3.html: no cart icon, adds "Get started" CTA on right.
            'hide_header_cart' => true,
            'header_cta_label' => 'Get started',
            'header_cta_url' => '/pricing',
            'footer_background_color' => '#ffffff',
            'footer_heading_color' => '#000000',
            'footer_text_color' => '#000000',
            'footer_border_color' => '#ffffff',
            'footer_background_image' => null,
            'header_homepage_light_text' => false,
            'footer_style' => '3',
            'footer_connect_title' => 'PURE PERFORMANCE',
            'footer_hours_label' => 'Mo - Sa',
            'footer_hours_value' => '9am - 5pm',
            'footer_promo_badge' => 'GET 20% OFF',
        ];
    }
}
