@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 2]) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.awards.styles.style-$style", compact('shortcode', 'awards')) !!}
