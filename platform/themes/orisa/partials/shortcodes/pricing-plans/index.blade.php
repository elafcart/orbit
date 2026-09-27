@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 3]) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.pricing-plans.styles.style-$style", compact('shortcode', 'plans')) !!}
