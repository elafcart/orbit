@php
    $style = (int) $shortcode->style;
    $style = in_array($style, [1, 2, 3, 4]) ? $style : 1;
@endphp

{!! Theme::partial("shortcodes.teams.styles.style-$style", compact('shortcode', 'teams')) !!}
