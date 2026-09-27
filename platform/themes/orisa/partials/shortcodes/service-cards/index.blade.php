@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 2]) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.service-cards.styles.style-$style", compact('shortcode', 'cards')) !!}
