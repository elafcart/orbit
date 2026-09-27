@php
    $footerStyle = (string) theme_option('footer_style', '1');
    $footerNamespace = Theme::getThemeNamespace('partials.footers.style-' . $footerStyle);
    $footerFallback  = Theme::getThemeNamespace('partials.footers.style-1');
@endphp

@includeFirst([$footerNamespace, $footerFallback])
