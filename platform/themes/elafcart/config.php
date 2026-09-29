<?php

use Botble\Theme\Theme;

return [
    'inherit' => null,

    'events' => [
        'beforeRenderTheme' => function (Theme $theme): void {
            $version = '2.0.0';

            // CSS
            $theme->asset()->usePath()->add('bootstrap', 'css/vendors/bootstrap.min.css');
            $theme->asset()->usePath()->add('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css');
            $theme->asset()->usePath()->add('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
            $theme->asset()->usePath()->add('theme', 'css/theme.css', version: $version);
            
            if (is_plugin_active('ecommerce')) {
                $theme->asset()->usePath()->add('ecommerce', 'css/ecommerce.css', version: $version);
            }

            // JS Footer
            $theme->asset()->container('footer')->usePath()->add('jquery', 'js/vendors/jquery-3.7.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap', 'js/vendors/bootstrap.bundle.min.js');
            $theme->asset()->container('footer')->usePath()->add('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js');
            $theme->asset()->container('footer')->usePath()->add('typed', 'https://cdn.jsdelivr.net/npm/typed.js@2.0.12');
            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js', version: $version);

            if (is_plugin_active('ecommerce')) {
                $theme->asset()->container('footer')->usePath()->add('ecommerce', 'js/ecommerce.js', version: $version);
            }

            // Enable shortcodes for pages
            if (function_exists('shortcode')) {
                $theme->composer(['page', 'index', 'post', 'portfolio.project', 'portfolio.service', 'ecommerce.product'], function (\Botble\Shortcode\View\View $view) {
                    $view->withShortcodes();
                });
            }
        },
    ],
];
