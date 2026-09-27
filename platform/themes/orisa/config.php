<?php

use Botble\Base\Facades\BaseHelper;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [
    'inherit' => null,

    'events' => [
        'beforeRenderTheme' => function (Theme $theme): void {
            $theme->addHtmlAttributes(['data-bs-theme' => theme_option('default_theme_mode', 'light')]);

            $version = get_cms_version();

            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.rtl.min.css');
            } else {
                $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.min.css');
            }

            $theme->asset()->usePath()->add('swiper-bundle', 'css/vendors/swiper-bundle.min.css');
            $theme->asset()->usePath()->add('carousel-ticker', 'css/vendors/carouselTicker.css');
            $theme->asset()->usePath()->add('magnific-popup-css', 'css/vendors/magnific-popup.css');
            $theme->asset()->usePath()->add('nice-select-css', 'css/vendors/nice-select.css');
            $theme->asset()->usePath()->add('odometer-css', 'css/vendors/odometer.css');
            $theme->asset()->usePath()->add('spacing', 'css/vendors/spacing.css');

            $theme->asset()->usePath()->add('main', 'css/main.css', version: $version);
            $theme->asset()->usePath()->add('theme', 'css/theme.css', version: $version);

            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('theme-rtl', 'css/rtl.css', version: $version);
            }

            // Ecommerce CSS (conditional)
            if (is_plugin_active('ecommerce')) {
                $theme->asset()->usePath()->add('ecommerce', 'css/ecommerce.css', version: $version);
            }

            // JS vendors (footer)
            $theme->asset()->container('footer')->usePath()->add('color-modes', 'js/vendors/color-modes.js');
            $theme->asset()->container('footer')->usePath()->add('jquery', 'js/vendors/jquery-3.7.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('plugin', 'js/vendors/plugin.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap', 'js/vendors/bootstrap.min.js');
            $theme->asset()->container('footer')->usePath()->add('swiper-bundle', 'js/vendors/swiper-bundle.min.js');
            $theme->asset()->container('footer')->usePath()->add('carousel-ticker', 'js/vendors/jquery.carouselTicker.min.js');
            $theme->asset()->container('footer')->usePath()->add('magnific-popup', 'js/vendors/jquery.magnific-popup.min.js');
            $theme->asset()->container('footer')->usePath()->add('odometer', 'js/vendors/jquery.odometer.min.js');
            $theme->asset()->container('footer')->usePath()->add('appear', 'js/vendors/jquery.appear.js');
            $theme->asset()->container('footer')->usePath()->add('nice-select', 'js/vendors/nice-select.js');
            $theme->asset()->container('footer')->usePath()->add('imagesloaded-theme', 'js/vendors/imagesloaded-pkgd.js');
            $theme->asset()->container('footer')->usePath()->add('isotope', 'js/vendors/isotope.pkgd.min.js');

            // Conditional animation libraries
            if (theme_option('animation_enabled', true)) {
                $theme->asset()->container('footer')->usePath()->add('splitting', 'js/vendors/splitting.js');
                $theme->asset()->container('footer')->usePath()->add('parallax', 'js/vendors/parallax.js');
                $theme->asset()->container('footer')->usePath()->add('image-hover', 'js/vendors/image-hover-effects.js');
                $theme->asset()->container('footer')->usePath()->add('ripple', 'js/vendors/ripple-2.js');
            }

            // Conditional magic cursor
            if (theme_option('magic_cursor_enabled', true)) {
                $theme->asset()->container('footer')->usePath()->add('at-cursor', 'js/at-cursor.js');
                $theme->asset()->container('footer')->usePath()->add('matter', 'js/matter.js');
                $theme->asset()->container('footer')->usePath()->add('throwable', 'js/throwable.js');
            }

            // Conditional product zoom
            if (is_plugin_active('ecommerce')) {
                $theme->asset()->container('footer')->usePath()->add('elevatezoom', 'js/vendors/jquery.elevatezoom.js');
                $theme->asset()->container('footer')->usePath()->add('ecommerce-products-carousel', 'js/ecommerce-products-carousel.js', version: $version);
            }

            // Satisfy ecommerce front-asset dependencies (front-ecommerce-js requires
            // jquery + lightgallery-js + slick-js). Orisa ships Swiper + Magnific Popup
            // instead of Slick + LightGallery, so register minimal stubs so the
            // dependency checker resolves and front-ecommerce-js loads.
            // Must come BEFORE EcommerceHelper::registerThemeAssets() below.
            $theme->asset()->container('footer')->usePath()->add('slick-js', 'js/vendors/slick.js');
            $theme->asset()->container('footer')->usePath()->add('lightgallery-js', 'js/vendors/lightgallery.js');

            // Strips the character-split animation hooks before main.js reads them.
            // Must stay ahead of the main JS below.
            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->container('footer')->usePath()->add('rtl-animations', 'js/rtl-animations.js', version: $version);
            }

            // Main JS
            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js', version: $version);

            // Shortcode composer for views that render shortcodes
            if (function_exists('shortcode')) {
                $theme->composer(
                    [
                        'page',
                        'post',
                        'portfolio.service',
                        'portfolio.project',
                        'teams.team',
                        'career.career',
                    ],
                    function (View $view): void {
                        $view->withShortcodes();
                    }
                );
            }
        },
    ],
];
