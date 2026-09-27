@php
    $style = (int) ($shortcode->style ?: 1);
    $style = in_array($style, range(1, 4)) ? $style : 1;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.projects.styles.style-$style"))
