@php
    $style = $shortcode->style;
    $style = in_array($style, [1, 2, 3]) ? $style : 1;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.call-to-action.styles.style-$style"))
