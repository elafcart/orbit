@php
    $style = $shortcode->style;
    $style = in_array($style, range(1, 11)) ? $style : 1;

    // Back-compat: legacy data stored style images in image_N, which collided
    // with the items tabs' flat image_N namespace. Prefer the new
    // style_image_N, fall back to image_N so legacy pages keep rendering.
    $styleImage1 = $shortcode->style_image_1 ?: $shortcode->image_1;
    $styleImage2 = $shortcode->style_image_2 ?: $shortcode->image_2;
    $styleImage3 = $shortcode->style_image_3 ?: $shortcode->image_3;
    $styleImage4 = $shortcode->style_image_4 ?: $shortcode->image_4;
@endphp

@include(Theme::getThemeNamespace("partials.shortcodes.content-block.styles.style-$style"))
