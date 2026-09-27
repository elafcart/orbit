@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 2, 3, 4, 5, 6, 7]) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.testimonials.styles.style-$style", compact('shortcode', 'tabs')) !!}
