<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts: loaded NON-blocking (media=print swap) so first paint stays fast.
         Fallback stack renders instantly; webfonts swap in when ready. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Space+Grotesk:wght@600;700&family=Noto+Sans+Bengali:wght@400;600&display=swap"
        rel="stylesheet"
        media="print"
        onload="this.media='all'"
    >
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Space+Grotesk:wght@600;700&family=Noto+Sans+Bengali:wght@400;600&display=swap" rel="stylesheet">
    </noscript>

    <meta name="theme-color" content="{{ theme_option('primary_color', '#4f46e5') }}" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#020617" media="(prefers-color-scheme: dark)">

    {{-- Dark mode: applied before first paint to avoid a flash of wrong theme --}}
    <script>
        (function () {
            try {
                if (localStorage.getItem('sixersoft-theme') === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>

    {{-- Primary color from Theme Options overrides the Tailwind brand token --}}
    <style>
        :root {
            --color-brand-600: {{ theme_option('primary_color', '#4f46e5') }};
        }
    </style>

    {!! Theme::header() !!}
</head>
<body {!! Theme::bodyAttributes() !!}>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    @include(Theme::getThemeNamespace('partials.header'))

    <main class="pt-16">
        @yield('content')
    </main>

    @include(Theme::getThemeNamespace('partials.footer'))

    {{-- Scroll to top --}}
    <button
        id="scroll-top-button"
        type="button"
        aria-label="{{ __('Scroll to top') }}"
        class="fixed right-5 bottom-5 z-40 flex size-11 items-center justify-center rounded-full bg-brand-600 text-white opacity-0 shadow-lg shadow-brand-600/30 transition duration-300 hover:opacity-90 pointer-events-none"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m18 15-6-6-6 6" />
        </svg>
    </button>

    {!! Theme::footer() !!}
</body>
</html>
