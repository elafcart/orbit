@php
    // Preloader image width is configurable via Theme Options → General → Preloader image width.
    // Falls back to the historic 50px default when the option is empty or invalid.
    $preloaderWidth = (int) theme_option('preloader_image_width', 50);
    $preloaderWidth = $preloaderWidth > 0 ? $preloaderWidth : 50;
@endphp
<div class="page-loader">
    <div class="page-loader-logo hide-animation" style="width: {{ $preloaderWidth }}px;">
        @if ($preloaderLogo = \Theme\Orisa\Support\ThemeHelper::sanitizeCommaCorruptedImage(theme_option('preloader_image')))
            {{ RvMedia::image($preloaderLogo, config('app.name'), null, true, ['data-width' => (string) $preloaderWidth]) }}
        @else
            <img alt="preloader image" src="{{ Theme::asset()->url('images/logo-w.svg') }}">
        @endif
    </div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
</div>
