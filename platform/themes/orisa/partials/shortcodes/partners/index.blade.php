@php
    $style = $shortcode->style;
    $style = in_array($style, [1, 2, 3, 4]) ? $style : 1;

    // Back-compat: legacy data stored style-3 images in image_N, which
    // collided with the partners tabs' flat image_N namespace. Prefer the
    // new style_image_N, fall back to image_N so legacy pages keep rendering.
    $styleImage1 = $shortcode->style_image_1 ?: $shortcode->image_1;
    $styleImage2 = $shortcode->style_image_2 ?: $shortcode->image_2;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.partners.styles.style-$style"))
