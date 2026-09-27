<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        {{-- Dark mode: apply before paint to prevent FOUC --}}
        <script>
            (function(){
                var s=localStorage.getItem('theme'),h=document.documentElement,
                    d=h.getAttribute('data-bs-theme');
                if(!s){s=(d==='system')?(window.matchMedia('(prefers-color-scheme:dark)').matches?'dark':'light'):(d||'light');}
                h.setAttribute('data-bs-theme',s);
            })();
        </script>

        @php
            $primaryColor = theme_option('primary_color', '#F0460E');
            $primaryColorRgb = implode(',', BaseHelper::hexToRgb($primaryColor));
            $secondaryColor = theme_option('secondary_color', '#1e1e1e');
            $secondaryColorRgb = implode(',', BaseHelper::hexToRgb($secondaryColor));
            $headingColor = theme_option('heading_color', '#1e1e1e');
            $bodyTextColor = theme_option('body_text_color', '#585959');
            $linkColor = theme_option('link_color', '#F0460E');
            $linkHoverColor = theme_option('link_hover_color', '#c93a0b');
        @endphp
        <style>
            :root {
                --primary-color: {{ $primaryColor }};
                --primary-color-rgb: {{ $primaryColorRgb }};
                --at-theme-primary: {{ $primaryColor }};
                --secondary-color: {{ $secondaryColor }};
                --secondary-color-rgb: {{ $secondaryColorRgb }};
                --heading-color: {{ $headingColor }};
                --body-text-color: {{ $bodyTextColor }};
                --link-color: {{ $linkColor }};
                --link-hover-color: {{ $linkHoverColor }};
            }
        </style>

        {!! Theme::header() !!}
    </head>
    @php
        // Home5 (footer style 5) matches index-5.html with a page-wide bg-neutral-50 on body.
        $bodyBgClass = (string) theme_option('footer_style', '1') === '5' ? 'bg-neutral-50' : '';
    @endphp
    <body @class([
        'at-magic-cursor' => theme_option('magic_cursor_enabled', true),
        $bodyBgClass => (bool) $bodyBgClass,
    ]) {!! Theme::bodyAttributes() !!}>
        {!! apply_filters(THEME_FRONT_BODY, null) !!}

        {!! Theme::partial('search-form') !!}

        @if (! Theme::get('withoutLayout'))
            {!! Theme::partial('header') !!}
        @endif

        {!! Theme::partial('magic-cursor') !!}

        @php
            $footerStyle = (string) theme_option('footer_style', '1');
            // Home5 (footer style 5) uses a light-gray page background matching index-5.html's `body.bg-neutral-50`.
            $mainBgClass = $footerStyle === '5' ? 'bg-neutral-50' : 'bg-neutral-0';
        @endphp
        <div id="smooth-wrapper">
            <div id="smooth-content"@if ($footerStyle === '2') class="z-index-3"@endif>
                <main class="{{ $mainBgClass }}">
                    @if (! Theme::get('withoutLayout'))
                        {!! Theme::breadcrumb()->render(Theme::getThemeNamespace('partials.breadcrumb')) !!}
                    @endif

                    @yield('content')
                </main>

                @if (! Theme::get('withoutLayout') && $footerStyle === '2')
                    <div class="footer-placeholder"></div>
                @endif

                @if (! Theme::get('withoutLayout') && $footerStyle !== '2')
                    {!! Theme::partial('footer') !!}
                @endif
            </div>

            @if (! Theme::get('withoutLayout') && $footerStyle === '2')
                {!! Theme::partial('footer') !!}
            @endif
        </div>

        {!! Theme::partial('scroll-to-top') !!}

        {!! Theme::footer() !!}

        @if (theme_option('hide_theme_mode_switcher', 'no') !== 'yes')
            <script>
                (function () {
                    var checkbox = document.getElementById('switch');
                    var storedTheme = localStorage.getItem('theme');
                    var htmlEl = document.documentElement;

                    if (!storedTheme) {
                        var htmlTheme = htmlEl.getAttribute('data-bs-theme');
                        storedTheme = (htmlTheme === 'system')
                            ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
                            : (htmlTheme || 'light');
                    }

                    var isDark = storedTheme === 'dark';
                    htmlEl.setAttribute('data-bs-theme', isDark ? 'dark' : 'light');
                    if (checkbox) checkbox.checked = isDark;

                    document.addEventListener('DOMContentLoaded', function () {
                        var cb = document.getElementById('switch');
                        if (!cb) return;
                        cb.checked = isDark;
                        cb.addEventListener('change', function () {
                            var dark = cb.checked;
                            localStorage.setItem('theme', dark ? 'dark' : 'light');
                            document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
                        });
                    });
                })();
            </script>
        @endif
    </body>
</html>
