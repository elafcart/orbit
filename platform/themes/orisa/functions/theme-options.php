<?php

use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\ThemeOption\Fields\ColorField;
use Botble\Theme\ThemeOption\Fields\MediaImageField;
use Botble\Theme\ThemeOption\Fields\NumberField;
use Botble\Theme\ThemeOption\Fields\RadioField;
use Botble\Theme\ThemeOption\Fields\RepeaterField;
use Botble\Theme\ThemeOption\Fields\SelectField;
use Botble\Theme\ThemeOption\Fields\TextareaField;
use Botble\Theme\ThemeOption\Fields\TextField;
use Botble\Theme\ThemeOption\Fields\ToggleField;
use Botble\Theme\ThemeOption\Fields\UiSelectorField;
use Botble\Theme\ThemeOption\ThemeOptionSection;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();
});

app('events')->listen(RenderingThemeOptionSettings::class, function (): void {
    theme_option()
        ->setSection([
            'title' => __('Header'),
            'id' => 'opt-text-subsection-header',
            'subsection' => true,
            'icon' => 'ti ti-layout-navbar',
            'fields' => [
                UiSelectorField::make()
                    ->name('header_style')
                    ->label(__('Header style'))
                    ->defaultValue('1')
                    ->options([
                        '1' => [
                            'label' => __('Style 1 - Transparent overlay'),
                        ],
                        '2' => [
                            'label' => __('Style 2 - Rounded card with topbar'),
                        ],
                        '3' => [
                            'label' => __('Style 3 - Narrow rounded card, centered nav'),
                        ],
                    ]),
                ToggleField::make()
                    ->name('sticky_header_enabled')
                    ->label(__('Enable sticky header'))
                    ->defaultValue(true),
                ToggleField::make()
                    ->name('header_transparent')
                    ->label(__('Transparent header (style 1 only)'))
                    ->defaultValue(true),
                ToggleField::make()
                    ->name('header_homepage_light_text')
                    ->label(__('Use light header text on homepage (dark hero)'))
                    ->defaultValue(true),
                ToggleField::make()
                    ->name('display_header_top')
                    ->label(__('Display header top?'))
                    ->defaultValue(false),
                ToggleField::make()
                    ->name('hide_header_cart')
                    ->label(__('Hide cart icon in header'))
                    ->defaultValue(false),
                ToggleField::make()
                    ->name('hide_header_account')
                    ->label(__('Hide account icon in header'))
                    ->defaultValue(false),
                ToggleField::make()
                    ->name('hide_header_search')
                    ->label(__('Hide search icon in header'))
                    ->defaultValue(false),
                ToggleField::make()
                    ->name('hide_header_language_switcher')
                    ->label(__('Hide language switcher in header'))
                    ->helperText(__('Hides the language list in the header menu panel. Only applies when the Language plugin is active with more than one language.'))
                    ->defaultValue(false),
                TextField::make()
                    ->name('header_cta_label')
                    ->label(__('Header CTA button label (e.g. Get started)')),
                TextField::make()
                    ->name('header_cta_url')
                    ->label(__('Header CTA button URL')),
                ColorField::make()
                    ->name('header_top_text_color')
                    ->defaultValue('#FEFEFE')
                    ->label(__('Header top text color')),
                ColorField::make()
                    ->name('header_top_background_color')
                    ->defaultValue('#1D1D1D')
                    ->label(__('Header top background color')),
                TextField::make()
                    ->name('header_top_address')
                    ->label(__('Header top address (style 2)')),
                TextField::make()
                    ->name('header_top_phone')
                    ->label(__('Header top phone (style 2)')),
                TextField::make()
                    ->name('header_top_email')
                    ->label(__('Header top email (style 2)')),
            ],
        ])
        ->setSection([
            'title' => __('Footer'),
            'id' => 'opt-text-subsection-footer',
            'subsection' => true,
            'icon' => 'ti ti-layout-bottombar',
            'fields' => [
                RadioField::make()
                    ->name('footer_style')
                    ->label(__('Footer style'))
                    ->defaultValue('1')
                    ->helperText(__('Switches between the bundled footer layouts (matches homepage demos).'))
                    ->options([
                        '1' => __('Style 1 — Creative Agency (Home 1)'),
                        '2' => __('Style 2 — Digital Agency (Home 2)'),
                        '3' => __('Style 3 — Marketing Agency (Home 3)'),
                        '4' => __('Style 4 — AI & Tech Agency (Home 4)'),
                        '5' => __('Style 5 — Personal Creative (Home 5)'),
                    ]),
                TextField::make()
                    ->name('footer_connect_title')
                    ->label(__("Footer \"Let's Connect\" title"))
                    ->helperText(__('Used by footer style 2.'))
                    ->defaultValue("Let's Connect"),
                TextField::make()
                    ->name('footer_hours_label')
                    ->label(__('Footer hours label'))
                    ->helperText(__('Used by footer style 2 (e.g. "Mo - Sa").'))
                    ->defaultValue('Mo - Sa'),
                TextField::make()
                    ->name('footer_hours_value')
                    ->label(__('Footer hours value'))
                    ->helperText(__('Used by footer styles 2 and 3 (e.g. "9am - 5pm").'))
                    ->defaultValue('9am - 5pm'),
                TextField::make()
                    ->name('footer_phone_secondary')
                    ->label(__('Secondary phone'))
                    ->helperText(__('Used by footer style 4 as an additional contact line.')),
                TextField::make()
                    ->name('footer_promo_badge')
                    ->label(__('Footer promo badge'))
                    ->helperText(__('Used by footer style 3 (e.g. "GET 20% OFF"). Leave empty to hide.')),
                ColorField::make()
                    ->name('footer_background_color')
                    ->defaultValue('#0a0a0a')
                    ->label(__('Background color')),
                MediaImageField::make()
                    ->name('footer_background_image')
                    ->label(__('Background image')),
                ColorField::make()
                    ->name('footer_text_color')
                    ->defaultValue('#ffffff')
                    ->label(__('Text color')),
                ColorField::make()
                    ->name('footer_heading_color')
                    ->defaultValue('#ffffff')
                    ->label(__('Heading color')),
                ColorField::make()
                    ->name('footer_border_color')
                    ->defaultValue('#303234')
                    ->label(__('Border color')),
                ToggleField::make()
                    ->name('footer_decoration_images_enabled')
                    ->label(__('Enable decoration images'))
                    ->defaultValue(false),
                TextField::make()
                    ->name('footer_brand_text')
                    ->label(__('Footer brand text'))
                    ->defaultValue('Orisa Studio'),
                TextareaField::make()
                    ->name('footer_service_tags')
                    ->label(__('Footer service tags'))
                    ->helperText(__('One per line'))
                    ->defaultValue("Web Development\nMotion Graphics\nBrand Strategy\nProduct Design"),
                TextField::make()
                    ->name('footer_heading')
                    ->label(__('Footer heading'))
                    ->helperText(__('Heading text displayed next to the footer logo.')),
                TextareaField::make()
                    ->name('footer_address')
                    ->label(__('Footer address'))
                    ->helperText(__('Displayed under the footer heading.')),
                TextField::make()
                    ->name('footer_phone')
                    ->label(__('Footer phone')),
                TextField::make()
                    ->name('footer_email')
                    ->label(__('Footer email')),
                TextField::make()
                    ->name('footer_since_year')
                    ->label(__('Founded year'))
                    ->helperText(__('Used by footer styles 1, 3 and 4 — renders as "[ Since {year} ]". Leave empty to hide.')),
            ],
        ])
        ->setSection([
            'title' => __('Offcanvas menu'),
            'id' => 'opt-text-subsection-offcanvas',
            'subsection' => true,
            'icon' => 'ti ti-menu-2',
            'fields' => [
                TextareaField::make()
                    ->name('offcanvas_description')
                    ->label(__('Description'))
                    ->helperText(__('Short intro text shown under "Howdy!" in the offcanvas menu drawer.')),
                TextField::make()
                    ->name('offcanvas_phone')
                    ->label(__('Phone')),
                TextField::make()
                    ->name('offcanvas_email')
                    ->label(__('Email')),
                TextareaField::make()
                    ->name('offcanvas_address')
                    ->label(__('Address')),
                MediaImageField::make()
                    ->name('offcanvas_gallery_image_1')
                    ->label(__('Gallery image 1')),
                MediaImageField::make()
                    ->name('offcanvas_gallery_image_2')
                    ->label(__('Gallery image 2')),
                MediaImageField::make()
                    ->name('offcanvas_gallery_image_3')
                    ->label(__('Gallery image 3')),
                MediaImageField::make()
                    ->name('offcanvas_gallery_image_4')
                    ->label(__('Gallery image 4')),
                MediaImageField::make()
                    ->name('offcanvas_gallery_image_5')
                    ->label(__('Gallery image 5')),
            ],
        ])
        ->setSection(
            ThemeOptionSection::make('styles')
                ->title(__('Styles'))
                ->icon('ti ti-palette')
                ->priority(1)
                ->fields([
                    RadioField::make()
                        ->label(__('Default theme mode'))
                        ->name('default_theme_mode')
                        ->defaultValue('light')
                        ->options([
                            'system' => __('System'),
                            'light' => __('Light'),
                            'dark' => __('Dark'),
                        ]),
                    RadioField::make()
                        ->label(__('Hide theme mode switcher'))
                        ->name('hide_theme_mode_switcher')
                        ->defaultValue('no')
                        ->options([
                            'no' => __('No'),
                            'yes' => __('Yes'),
                        ]),
                    ToggleField::make()
                        ->name('animation_enabled')
                        ->label(__('Enable animation?'))
                        ->defaultValue(true),
                    ToggleField::make()
                        ->name('magic_cursor_enabled')
                        ->label(__('Enable magic cursor?'))
                        ->defaultValue(true),
                    ColorField::make()
                        ->name('primary_color')
                        ->label(__('Primary color'))
                        ->defaultValue('#F0460E'),
                    ColorField::make()
                        ->name('secondary_color')
                        ->label(__('Secondary color'))
                        ->defaultValue('#1e1e1e'),
                    ColorField::make()
                        ->name('heading_color')
                        ->label(__('Heading color'))
                        ->defaultValue('#1e1e1e'),
                    ColorField::make()
                        ->name('body_text_color')
                        ->label(__('Body text color'))
                        ->defaultValue('#585959'),
                    ColorField::make()
                        ->name('link_color')
                        ->label(__('Link color'))
                        ->defaultValue('#F0460E'),
                    ColorField::make()
                        ->name('link_hover_color')
                        ->label(__('Link hover color'))
                        ->defaultValue('#c93a0b'),
                    ToggleField::make()
                        ->name('back_to_top_enabled')
                        ->label(__('Enable back to top button'))
                        ->defaultValue(true),
                ])
        )
        ->setField(
            MediaImageField::make()
                ->name('404_image')
                ->sectionId('opt-text-subsection-general')
                ->label(__('404 Image'))
        )
        ->setField(
            MediaImageField::make()
                ->name('breadcrumb_background_image')
                ->sectionId('opt-text-subsection-breadcrumb')
                ->label(__('Background image'))
        )
        ->setField(
            ColorField::make()
                ->name('breadcrumb_background_color')
                ->sectionId('opt-text-subsection-breadcrumb')
                ->label(__('Background color'))
        )
        ->setField(
            MediaImageField::make()
                ->sectionId('opt-text-subsection-general')
                ->name('preloader_image')
                ->label(__('Preloader image'))
        )
        ->setField(
            NumberField::make()
                ->sectionId('opt-text-subsection-general')
                ->name('preloader_image_width')
                ->label(__('Preloader image width'))
                ->helperText(__('Width of the preloader image in pixels (default: 50).'))
                ->defaultValue(50)
        )
        ->setField(
            TextareaField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('suggest_keywords')
                ->label(__('Suggest keywords'))
                ->helperText(__('Separate by comma'))
        )
        ->setField(
            TextareaField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_description')
                ->label(__('Blog subheading'))
                ->helperText(__('Short supporting text rendered as H2 below the main blog title on the blog archive page.'))
        )
        ->setField(
            SelectField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_post_title_heading_level')
                ->label(__('Post title heading level on archive pages'))
                ->helperText(__('Semantic level for post titles in the blog archive, category, tag and search listings. H2 (default) keeps the outline continuous under the archive H1. The visual size is set by the card CSS and does not change with this setting. Post cards in the Blog posts shortcode are configured separately.'))
                ->defaultValue('h2')
                ->options([
                    'h2' => __('H2 (default)'),
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => __('Regular text (no heading)'),
                ])
        )
        ->setField(
            ToggleField::make()
                ->sectionId('opt-text-subsection-blog')
                ->name('blog_featured_enabled')
                ->label(__('Show featured posts on blog page'))
                ->helperText(__('When enabled, the first 3 posts are shown as a featured hero (the first one larger). Disable to render all posts in a uniform grid.'))
                ->defaultValue(true)
        )
        ->when(is_plugin_active('ecommerce'), function () {
            theme_option()
                ->setSection([
                    'title' => __('Ecommerce'),
                    'id' => 'opt-text-subsection-ecommerce',
                    'subsection' => true,
                    'icon' => 'ti ti-shopping-cart',
                    'fields' => [
                        UiSelectorField::make()
                            ->name('product_detail_gallery_style')
                            ->label(__('Product image layout'))
                            ->helperText(__('Grid: the default 2-column image grid (best for physical products). Gallery: a large main image with a clickable thumbnail strip, plus full-width description/reviews tabs (best for digital products).'))
                            ->options([
                                'grid' => [
                                    'label' => __('Grid'),
                                ],
                                'gallery' => [
                                    'label' => __('Gallery'),
                                ],
                            ])
                            ->defaultValue('grid'),
                        TextField::make()
                            ->name('product_detail_info_title')
                            ->label(__('Product detail info title'))
                            ->defaultValue('Shipping & Returns'),
                        RepeaterField::make()
                            ->name('product_detail_info_items')
                            ->label(__('Product detail info items'))
                            ->fields([
                                TextField::make()
                                    ->name('text')
                                    ->label(__('Text')),
                            ]),
                    ],
                ]);
        })
        ->when(is_plugin_active('portfolio'), function () {
            theme_option()
                ->setSection([
                    'title' => __('Portfolio'),
                    'id' => 'opt-text-subsection-portfolio',
                    'subsection' => true,
                    'icon' => 'ti ti-briefcase',
                    'fields' => [
                        UiSelectorField::make()
                            ->name('service_style')
                            ->label(__('Service style'))
                            ->options([
                                'style-1' => [
                                    'label' => __('Style :number', ['number' => 1]),
                                ],
                                'style-2' => [
                                    'label' => __('Style :number', ['number' => 2]),
                                ],
                            ])
                            ->defaultValue('style-1'),
                    ],
                ]);
        })
        ->setField([
            'id' => 'logo_text',
            'section_id' => 'opt-text-subsection-logo',
            'type' => 'text',
            'label' => __('Logo text'),
            'attributes' => [
                'name' => 'logo_text',
                'value' => null,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => __('Short brand name displayed next to logo'),
                ],
            ],
            'priority' => 95,
        ])
        ->setField([
            'id' => 'logo_dark',
            'section_id' => 'opt-text-subsection-logo',
            'type' => 'mediaImage',
            'label' => __('Alternative logo (for light backgrounds)'),
            'helperText' => __('Dark-coloured logo used in the hamburger menu panel and other light-background areas. Falls back to the main logo if empty.'),
            'attributes' => [
                'name' => 'logo_dark',
                'value' => null,
                'attributes' => ['allow_thumb' => false],
            ],
            'priority' => 96,
        ])
        ->setField([
            'id' => 'logo_dark_mode',
            'section_id' => 'opt-text-subsection-logo',
            'type' => 'mediaImage',
            'label' => __('Dark mode logo'),
            'helperText' => __('Light-coloured logo shown in the main header when the site is in dark mode. Falls back to the main logo if empty.'),
            'attributes' => [
                'name' => 'logo_dark_mode',
                'value' => null,
                'attributes' => ['allow_thumb' => false],
            ],
            'priority' => 97,
        ])
        ->setField(
            NumberField::make()
                ->sectionId('opt-text-subsection-logo')
                ->name('logo_height_desktop')
                ->label(__('Logo height on desktop (px)'))
                ->helperText(__('Height in pixels for screens ≥1200px. Leave empty to use the theme default.'))
                ->priority(101)
        )
        ->setField(
            NumberField::make()
                ->sectionId('opt-text-subsection-logo')
                ->name('logo_height_tablet')
                ->label(__('Logo height on tablet (px)'))
                ->helperText(__('Height in pixels for screens 768–1199px. Leave empty to inherit the desktop value.'))
                ->priority(102)
        )
        ->setField(
            NumberField::make()
                ->sectionId('opt-text-subsection-logo')
                ->name('logo_height_mobile')
                ->label(__('Logo height on mobile (px)'))
                ->helperText(__('Height in pixels for screens <768px. Leave empty to inherit the tablet/desktop value.'))
                ->priority(103)
        )
        ->setField(
            NumberField::make()
                ->sectionId('opt-text-subsection-logo')
                ->name('logo_max_width')
                ->label(__('Logo max width (px)'))
                ->helperText(__('Caps the logo image width. Leave empty for no cap. Useful for very wide horizontal logos.'))
                ->priority(104)
        );
});
