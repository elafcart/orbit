<?php

use Botble\Theme\Supports\ThemeSupport;

register_page_template([
    'default' => __('Default'),
    'homepage' => __('Homepage'),
    'full-width' => __('Full Width'),
]);

app()->booted(function (): void {
    ThemeSupport::registerSiteCopyright();
    ThemeSupport::registerSocialLinks();
    ThemeSupport::registerSocialSharing();

    // Performance: automatically add loading="lazy" + decoding="async" to
    // images inside CMS content (pages / posts) below the fold.
    ThemeSupport::registerLazyLoadImages();
});
