<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Page\Database\Traits\HasPageSeeder;
use Botble\Theme\Database\Traits\HasThemeOptionSeeder;
use Botble\Theme\Supports\ThemeSupport;

class ThemeOptionSeeder extends BaseSeeder
{
    use HasThemeOptionSeeder;
    use HasPageSeeder;

    public function run(): void
    {
        $settings = [
            'admin_favicon' => $this->filePath('general/favicon.webp'),
            'admin_logo' => $this->filePath('general/logo-white.png'),
        ];

        $this->saveSettings($settings);

        $this->createThemeOptions($this->getThemeOptions());
    }

    public function getThemeOptions(): array
    {
        return [
            'favicon' => $this->filePath('general/favicon.webp'),
            // Primary logo: light-coloured cube (favicon-dark.png) — visible on the dark homepage hero
            // where the main header overlays. Used by `Theme::getLogo()`.
            'logo' => $this->filePath('general/favicon-dark.png'),
            // Alternate logo: dark-coloured cube (favicon-light.png) — visible on light-background
            // surfaces such as the offcanvas hamburger panel. Fetched via `Theme::getLogo('logo_dark')`.
            'logo_dark' => $this->filePath('general/favicon-light.png'),
            'site_title' => 'Orisa',
            'logo_text' => 'Orisa',
            'seo_description' => 'Orisa - Creative Agency & Portfolio HTML Template. Multi-demo layout kit built with Bootstrap 5.',
            'footer_brand_text' => 'Orisa Studio',
            'copyright' => 'Orisa © %Y',
            'footer_service_tags' => 'Web Development, Motion Graphics, Brand Strategy, Product Design',
            '404_image' => $this->filePath('general/404.webp'),
            'breadcrumb_background_image' => $this->filePath('backgrounds/breadcrumb.webp'),
            'social_links' => ThemeSupport::getDefaultSocialLinksData(),
            'primary_color' => '#F0460E',
            'tp_primary_font' => 'DM Sans',
            'homepage_id' => $this->getPageId('Homepage'),
            'blog_page_id' => $this->getPageId('Blog'),
            'default_theme_mode' => 'light',
            'newsletter_popup_enable' => true,
            'newsletter_popup_image' => $this->filePath('general/features-6.webp'),
            'newsletter_popup_title' => 'Stay Updated with Orisa',
            'newsletter_popup_subtitle' => 'Newsletter',
            'newsletter_popup_description' => "Join our newsletter and discover how Orisa's creative agency theme can transform your digital presence with modern, responsive design and powerful features.",
            'footer_background_image' => $this->filePath('general/line-bg.gif'),
            'suggest_keywords' => 'Agency, Creative, Portfolio, Branding, Design, Marketing',
            'footer_text_color' => '#ffffff',
            'footer_background_color' => '#111827',
            'footer_heading_color' => '#ffffff',
            'footer_border_color' => '#303234',
            'footer_since_year' => '2012',
            'footer_heading' => "Let's Shape <br> Your Next Idea",
            'footer_phone' => '(212) 555-7398',
            'footer_email' => 'hello@orisa.com',
            'footer_address' => '205 North Michigan Avenue, Suite 810 <br> Chicago, 60601, USA',
            'offcanvas_phone' => '(212) 555-7398',
            'offcanvas_email' => 'hello@orisa.com',
            'offcanvas_address' => '245 Fifth Avenue, Suite 1800 <br> New York, NY 10016, USA',
            'offcanvas_gallery_image_1' => $this->filePath('general/offcanvas-1.webp'),
            'offcanvas_gallery_image_2' => $this->filePath('general/offcanvas-2.webp'),
            'offcanvas_gallery_image_3' => $this->filePath('general/offcanvas-3.webp'),
            'offcanvas_gallery_image_4' => $this->filePath('general/offcanvas-4.webp'),
            'offcanvas_gallery_image_5' => $this->filePath('general/offcanvas-5.webp'),
            // Header defaults — individual Home variants override these as needed.
            // Keeping explicit values here ensures each variant starts from a clean baseline
            // when seeders run in succession (theme options persist across seeder runs).
            'hide_header_cart' => false,
            'header_cta_label' => '',
            'header_cta_url' => '',
            'product_detail_info_title' => 'Shipping & Returns',
            'product_detail_info_items' => json_encode([
                [['key' => 'text', 'value' => 'Free standard shipping on orders over $50']],
                [['key' => 'text', 'value' => 'Express delivery available (2-3 business days)']],
                [['key' => 'text', 'value' => '30-day easy returns & exchanges']],
                [['key' => 'text', 'value' => 'Secure checkout with SSL encryption']],
            ]),
        ];
    }
}
