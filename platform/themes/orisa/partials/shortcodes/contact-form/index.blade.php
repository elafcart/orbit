@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 2, 3]) ? $style : 1;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.contact-form.styles.style-$style"))
