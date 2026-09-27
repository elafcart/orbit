@php
    $style = $shortcode->style;
    $style = in_array($style, [1, 2]) ? $style : 1;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.blog-posts.styles.style-$style"))
