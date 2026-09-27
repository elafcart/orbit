@php
    $style = (int) $shortcode->style;
    $style = in_array($style, range(1, 5)) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.services.styles.style-$style", compact('shortcode', 'services')) !!}
