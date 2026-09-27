@php
    $style = (int) $shortcode->style;
    $style = in_array($style, range(1, 9)) ? $style : 1;

    // Back-compat: legacy data stored hero images in image_N, which collided
    // with Feature tabs' flat image_N namespace. Prefer the new style_image_N,
    // fall back to image_N so existing pages keep rendering before migration.
    $styleImage1 = $shortcode->style_image_1 ?: $shortcode->image_1;
    $styleImage2 = $shortcode->style_image_2 ?: $shortcode->image_2;
    $styleImage3 = $shortcode->style_image_3 ?: $shortcode->image_3;
@endphp

{!! Theme::partial("shortcodes.about-us-information.styles.style-$style", compact('shortcode', 'tabs', 'avatars', 'styleImage1', 'styleImage2', 'styleImage3')) !!}
