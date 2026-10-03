<?php

use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [
    'inherit' => null,

    'events' => [
        'beforeRenderTheme' => function (Theme $theme): void {
            $version = '1.0.0';

            // Animations can be switched off from Theme Options for max speed —
            // main.js reads the attribute and skips all GSAP work.
            if (! theme_option('animations_enabled', true)) {
                $theme->addBodyAttributes(['data-sx-animations' => 'off']);
            }

            // Tailwind CSS v4 compiled stylesheet (built by Vite — see vite.build.mjs)
            $theme->asset()->usePath()->add('sixersoft-style', 'css/theme.css', version: $version);

            // GSAP powered main script (bundled by Vite as a self-executing IIFE)
            $theme->asset()->container('footer')->usePath()->add('sixersoft-main', 'js/main.js', version: $version);

            if (is_plugin_active('ecommerce')) {
                // The ecommerce front script (jQuery-based) needs these handles
                // to exist before its assets are registered below.
                $theme->asset()->container('footer')->usePath()->add('jquery', 'js/vendors/jquery.min.js');
                $theme->asset()->container('footer')->usePath()->add('slick-js', 'js/vendors/slick.js');
                $theme->asset()->container('footer')->usePath()->add('lightgallery-js', 'js/vendors/lightgallery.js');

                // Tabler icons webfont — used by the ecommerce plugin's own markup
                // (quantity steppers, buttons, empty states).
                $theme->asset()->usePath()->add('tabler-icons', 'https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css');

                // Tailwind theme: ship the plugin's bootstrap-compat layer so the
                // plugin-rendered markup (checkout, modals, forms) stays usable.
                EcommerceHelper::useTailwindCSS();
                EcommerceHelper::registerThemeAssets();
            }

            // Enable shortcodes inside rendered views
            if (function_exists('shortcode')) {
                $theme->composer(['page', 'index', 'post', 'portfolio.project', 'portfolio.service', 'portfolio.services', 'portfolio.category'], function (View $view): void {
                    $view->withShortcodes();
                });
            }
        },
    ],
];
