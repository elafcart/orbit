<?php

namespace Database\Seeders\Themes\Home4;

class ThemeOptionSeeder extends \Database\Seeders\Themes\Main\ThemeOptionSeeder
{
    public function getThemeOptions(): array
    {
        return [
            ...parent::getThemeOptions(),
            // Home4's header card is on a light background, so swap the primary logo to the dark-coloured variant
            // (favicon-light.png — the dark cube). Main seeder defaults to favicon-dark.png (light cube for dark hero).
            'logo' => $this->filePath('general/favicon-light.png'),
            'site_title' => 'Orisa — AI & Technology Agency',
            'seo_description' => 'Orisa is a versatile Botble CMS theme tailored for AI and technology agencies. Built on Bootstrap 5, it offers professional, responsive designs to suit diverse business needs.',
            'primary_color' => '#F0460E',
            'tp_primary_font' => 'DM Sans',
            'copyright' => 'Copyright © %Y Orisa. All Rights Reserved',
            'newsletter_popup_title' => 'Stay Updated with Orisa',
            'newsletter_popup_description' => "Join our newsletter and discover how Orisa's multipurpose AI & tech agency solution can transform your digital presence with modern, responsive design and powerful features.",
            'footer_background_image' => null,
            'header_style' => '2',
            'header_transparent' => false,
            'header_top_address' => '66 avenue des Champs, 75008, Paris, France',
            'header_top_phone' => '(+01) - 456 789',
            'header_top_email' => 'hello@orisa.com',
            // Home4 header matches index-4.html: no cart icon, adds "Get Started" CTA on right.
            'hide_header_cart' => true,
            'header_cta_label' => 'Get Started',
            'header_cta_url' => '/pricing',
            'footer_style' => '4',
            'footer_brand_text' => 'Orisa AI Solutions',
            'footer_phone' => '+212 - 555-7398',
            'footer_phone_secondary' => '+212 - 666-7399',
        ];
    }
}
