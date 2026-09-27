@php
    // Primary logo (light-coloured cube) for the main header — stays visible on the dark homepage hero.
    $logoUrl = Theme::getLogo() ? RvMedia::getImageUrl(Theme::getLogo()) : Theme::asset()->url('images/logo/favicon-dark.svg');
    // Alternate dark-coloured logo for light-background surfaces (offcanvas panels). Falls back to the primary logo.
    $logoDark = Theme::getLogo('logo_dark') ?: Theme::getLogo();
    $logoDarkUrl = $logoDark ? RvMedia::getImageUrl($logoDark) : Theme::asset()->url('images/logo/favicon.svg');
    // Dedicated dark-mode logo for the main header. When set, the image is swapped
    // in via CSS (content: url) whenever `[data-bs-theme="dark"]` is active so the
    // customer can ship a contrasting variant without touching every header style.
    $logoDarkModeMedia = Theme::getLogo('logo_dark_mode');
    $logoDarkModeUrl = $logoDarkModeMedia ? RvMedia::getImageUrl($logoDarkModeMedia) : null;
    $siteName = theme_option('site_title', config('app.name'));
    $logoText = theme_option('logo_text', $siteName);
    $homepageUrl = BaseHelper::getHomepageUrl();
    $isHomepage = BaseHelper::isHomepage() || request()->is('/');
    $headerStyle = (int) theme_option('header_style', 1);
    $headerStyle = in_array($headerStyle, [1, 2, 3]) ? $headerStyle : 1;
@endphp

@if ($logoDarkModeUrl)
    <style>
        [data-bs-theme="dark"] .at-header-area .at-header-logo img,
        [data-bs-theme="dark"] .at-search-logo img,
        /* Both offcanvas panels render the logo too — the "Get in touch" sidebar
           (.at-offcanvas-logo) and the hamburger menu (.at-offcanvas-2-wrapper).
           They were left out of this swap, so main.css kept inverting them and a
           two-colour logo came out with its accent hue rotated (ticket 4576241). */
        [data-bs-theme="dark"] .at-offcanvas-logo img,
        [data-bs-theme="dark"] .at-offcanvas-2-wrapper .at-header-logo img {
            content: url("{{ $logoDarkModeUrl }}");
            /* main.css inverts the header logo in dark mode as a fallback for single-colour
               logos. A dedicated dark-mode logo is already the right colours, so inverting it
               again would wreck it — cancel the filter whenever we swap the source. */
            filter: none !important;
        }
    </style>
@endif

@php
    // Buyer-defined logo sizing. All controls live under Theme Options → Logo:
    // the single `logo_height` field (registered by ThemeSupport::registerSiteLogoHeight)
    // sets the base height; `logo_height_desktop/tablet/mobile` override it per
    // breakpoint when set, and `logo_max_width` caps very wide logos.
    // !important guards against theme defaults that target the same selector.
    $logoHeightBase    = (int) theme_option('logo_height', 37);
    $logoHeightDesktop = (int) theme_option('logo_height_desktop', 0) ?: $logoHeightBase;
    $logoHeightTablet  = (int) theme_option('logo_height_tablet', 0);
    $logoHeightMobile  = (int) theme_option('logo_height_mobile', 0);
    $logoMaxWidth      = (int) theme_option('logo_max_width', 0);
@endphp
@if ($logoHeightDesktop || $logoHeightTablet || $logoHeightMobile || $logoMaxWidth)
    <style>
        @if ($logoHeightDesktop)
        .at-header-logo img,
        .at-offcanvas-logo img {
            height: {{ $logoHeightDesktop }}px !important;
            width: auto !important;
            max-width: 100%;
        }
        @endif
        @if ($logoMaxWidth)
        .at-header-logo img,
        .at-offcanvas-logo img {
            max-width: {{ $logoMaxWidth }}px;
        }
        @endif
        @if ($logoHeightTablet)
        @media (max-width: 1199.98px) {
            .at-header-logo img,
            .at-offcanvas-logo img {
                height: {{ $logoHeightTablet }}px !important;
            }
        }
        @endif
        @if ($logoHeightMobile)
        @media (max-width: 767.98px) {
            .at-header-logo img,
            .at-offcanvas-logo img {
                height: {{ $logoHeightMobile }}px !important;
            }
        }
        @endif
    </style>
@endif

{{-- Optional announcement bar above the visible header. Only renders when
     "Display header top" is enabled in Theme Options and the linked widget
     sidebars (header_top_start_sidebar / header_top_end_sidebar) are filled. --}}
{!! Theme::partial('header-top') !!}

{{-- Visible header (style variant) --}}
@include(Theme::getThemeNamespace("partials.header.styles.style-$headerStyle"))

{{-- Offcanvas sidebar (desktop) --}}
<div class="at-offcanvas-area">
    <div class="at-offcanvas">
        <div class="at-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="at-offcanvas-logo">
                <a href="{{ $homepageUrl }}">
                    <img data-width="30" src="{{ $logoDarkUrl }}" alt="{{ $siteName }}">
                    <p class="h6 fw-700 fz-24 mb-0">{{ $logoText }}</p>
                </a>
            </div>
            <div class="at-offcanvas-close-btn">
                <button class="close-btn" aria-label="{{ __('Close') }}">
                    <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>

        @php $offcanvasContent = theme_option('offcanvas_description'); @endphp
        <div class="at-offcanvas-content d-none d-xl-block">
            <p class="at-offcanvas-title">{{ __('Howdy!') }}</p>
            @if($offcanvasContent)
                <p class="fz-font-lg">{!! BaseHelper::clean($offcanvasContent) !!}</p>
            @endif
        </div>

        {{-- Mobile navigation inside offcanvas --}}
        <div class="at-offcanvas-menu d-xl-none pb-50">
            <nav>
                {!! Menu::renderMenuLocation('main-menu', [
                    'view' => 'mobile-menu',
                    'options' => ['class' => 'at-offcanvas-mobile-menu list-unstyled p-0'],
                ]) !!}
            </nav>
        </div>

        @php
            $offcanvasPhone   = theme_option('offcanvas_phone');
            $offcanvasEmail   = theme_option('offcanvas_email');
            $offcanvasAddress = theme_option('offcanvas_address');
        @endphp
        @if ($offcanvasPhone || $offcanvasEmail || $offcanvasAddress)
            <div class="at-offcanvas-contact">
                <p class="h5 at-offcanvas-title sm">{{ __('Get in touch') }}</p>
                <ul>
                    @if ($offcanvasPhone)
                        <li><a class="fz-font-lg" href="tel:{{ $offcanvasPhone }}">{{ $offcanvasPhone }}</a></li>
                    @endif
                    @if ($offcanvasEmail)
                        <li><a class="fz-font-lg" href="mailto:{{ $offcanvasEmail }}">{{ $offcanvasEmail }}</a></li>
                    @endif
                    @if ($offcanvasAddress)
                        <li><a class="fz-font-lg" href="#">{!! BaseHelper::clean($offcanvasAddress) !!}</a></li>
                    @endif
                </ul>
            </div>
        @endif

        @php
            // Run each value through sanitizeCommaCorruptedImage so legacy comma-joined
            // values (same root cause that hit the About-page images) render as a single
            // path instead of a malformed URL.
            $offcanvasImages = collect(range(1, 5))
                ->map(fn ($i) => \Theme\Orisa\Support\ThemeHelper::sanitizeCommaCorruptedImage(theme_option("offcanvas_gallery_image_$i")))
                ->filter();
        @endphp
        @if($offcanvasImages->isNotEmpty())
            <div class="at-offcanvas-gallery d-none d-xl-block">
                <div class="sec-2-home-5__avatars-row d-flex gap-2">
                    @foreach($offcanvasImages as $image)
                        <div class="sec-2-home-5__avatar-sm at-offcanvas-gallery-img">
                            {{ RvMedia::image($image, $siteName, attributes: ['class' => 'img-cover']) }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @php
            $offcanvasSocialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());
        @endphp
        @if($offcanvasSocialLinks->isNotEmpty())
            <div class="at-offcanvas-social">
                <p class="at-offcanvas-title sm">{{ __('Follow Us') }}</p>
                <ul class="at-offcanvas-social__grid list-unstyled">
                    @foreach($offcanvasSocialLinks as $social)
                        <li>
                            <a href="{{ $social->getUrl() }}" class="at-offcanvas-social__link" aria-label="{{ $social->getName() }}" target="_blank" rel="noopener noreferrer">
                                <x-core::icon :name="$social->getIcon()" />
                                <span>{{ $social->getName() }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Language & Currency Switcher (inline list) --}}
        {!! Theme::partial('header.mobile-switchers') !!}
    </div>
</div>
<div class="body-overlay"></div>

{{-- Offcanvas 2 — hamburger menu (all screen sizes) --}}
<div class="at-offcanvas-2-area">
    <div class="offcanvas-bg"></div>
    <div class="at-offcanvas-2-wrapper offcanvas-menu">
        <div class="at-offcanvas-2-left">
            <div class="at-header-logo d-flex justify-content-between align-items-center mb-50">
                <a href="{{ $homepageUrl }}">
                    <img class="dark-mode-invert" data-width="30" src="{{ $logoDarkUrl }}" alt="{{ $siteName }}">
                    <p class="h6 fw-700 fz-24 mb-0">{{ $logoText }}</p>
                </a>
                <span class="hamburger-close-btn" role="button" aria-label="{{ __('Close menu') }}">
                    <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>

            <div class="at-offcanvas-menu counter-row">
                <nav>
                    {!! Menu::renderMenuLocation('main-menu', [
                        'view' => 'mobile-menu',
                        'options' => ['class' => 'at-hamburger-menu list-unstyled p-0'],
                    ]) !!}
                </nav>
            </div>

            {{-- Social links --}}
            @php
                $hamburgerSocialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());
            @endphp
            @if($hamburgerSocialLinks->isNotEmpty())
                <div class="at-offcanvas-social at-hamburger-social mt-40">
                    <ul class="at-offcanvas-social__grid list-unstyled">
                        @foreach($hamburgerSocialLinks as $social)
                            <li>
                                <a href="{{ $social->getUrl() }}" class="at-offcanvas-social__link" aria-label="{{ $social->getName() }}" target="_blank" rel="noopener noreferrer">
                                    <x-core::icon :name="$social->getIcon()" />
                                    <span>{{ $social->getName() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <span class="hamburger-close-btn hamburger-mobile-close-btn d-md-none" role="button">{{ __('CLOSE') }}</span>
        </div>
    </div>
</div>

<div class="px-blur-bottom"></div>

{{--
    Publish the rendered header height as `--at-header-height` on the document root.

    The header is a sibling of `#smooth-wrapper`, so it paints over the page rather
    than pushing it down and every view has to reserve its own top space. A literal
    padding cannot track a height that changes with the header style, the topbar
    toggle and the breakpoint, which is how a project title ended up underneath the
    header on header style 2 (ticket 4576446). Views opt in with `.at-header-offset`.
--}}
<script>
    (function () {
        var header = document.querySelector('body > header');

        if (! header) {
            return;
        }

        // Style 1 overlays the page with an absolutely positioned bar, which collapses
        // <header> itself to zero height, so its own box is not a usable measurement.
        // Offsets (not getBoundingClientRect) keep this independent of scroll position.
        var measure = function () {
            var bars = header.querySelectorAll('.at-header-area');
            var clearance = header.offsetTop + header.offsetHeight;

            for (var i = 0; i < bars.length; i++) {
                var bottom = bars[i].offsetTop + bars[i].offsetHeight;

                if (bottom > clearance) {
                    clearance = bottom;
                }
            }

            return clearance;
        };

        var publish = function () {
            document.documentElement.style.setProperty('--at-header-height', measure() + 'px');
        };

        publish();

        if (window.ResizeObserver) {
            new ResizeObserver(publish).observe(header);
        } else {
            window.addEventListener('resize', publish);
        }

        window.addEventListener('load', publish);
    })();
</script>
