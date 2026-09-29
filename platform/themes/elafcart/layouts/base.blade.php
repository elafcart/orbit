<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!} lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ BaseHelper::isRtlEnabled() ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    {!! Theme::header() !!}

    <!-- Multi-language hreflang for SEO -->
    @if(is_plugin_active('language'))
        {!! Theme::partial('hreflang') !!}
    @endif
    
    <style>
        :root {
            --primary: {{ theme_option('primary_color', '#6366f1') }};
            --primary-dark: #4f46e5;
            --dark: #0f0f0f;
            --dark-light: #1a1a1a;
            --text-muted: #6b7280;
        }
        /* RTL Support */
        @if(BaseHelper::isRtlEnabled())
        body { direction: rtl; }
        .text-lg-end { text-align: left !important; }
        .ms-auto { margin-left: 0 !important; margin-right: auto !important; }
        .ms-lg-4 { margin-left: 0 !important; margin-right: 1.5rem !important; }
        .me-2 { margin-right: 0 !important; margin-left: 0.5rem !important; }
        @endif
    </style>
</head>
<body {!! Theme::bodyAttributes() !!} class="portfolio-body {{ BaseHelper::isRtlEnabled() ? 'rtl' : '' }}">
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    @include(Theme::getThemeNamespace('partials.header'))

    <main class="main-wrapper">
        @yield('content')
    </main>

    @include(Theme::getThemeNamespace('partials.footer'))

    <!-- Scroll to top -->
    <button class="scroll-top" id="scrollTop">
        <i class="bi bi-arrow-up"></i>
    </button>

    {!! Theme::footer() !!}
</body>
</html>
