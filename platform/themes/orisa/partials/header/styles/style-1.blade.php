{{-- Header Style 1: transparent overlay (matches index.html, index-2.html, index-3.html, index-5.html) --}}
@php
    // Light text only when explicitly enabled AND on homepage (default: enabled for Home v.1 dark hero)
    $lightText = $isHomepage && theme_option('header_homepage_light_text', true);

    // Layout widths flex based on whether a CTA button (e.g. Home3 "Get started") is shown.
    // With CTA: narrower logo + left-aligned nav + wider right col (index-3.html pattern).
    // Without CTA: centered nav, equal side cols (index.html / index-2.html pattern).
    $hasHeaderCta = (bool) theme_option('header_cta_label');
    $logoCol = $hasHeaderCta ? 'col-xl-1' : 'col-xl-2';
    $navCol = $hasHeaderCta ? 'col-xl-7 me-auto' : 'col-xl-8 mx-auto';
    $rightCol = $hasHeaderCta ? 'col-xl-4' : 'col-xl-2';
    $navAlign = $hasHeaderCta ? 'justify-content-start' : 'justify-content-center';
@endphp
<header>
    <div class="at-header-area at-header-spacing {{ theme_option('header_transparent', true) ? 'header-transparent' : '' }}">
        <div class="container">
            <div class="row align-items-center">
                {{-- Logo --}}
                <div class="{{ $logoCol }} col-6">
                    <div class="at-header-logo">
                        <a href="{{ $homepageUrl }}">
                            <img data-width="30" src="{{ $logoUrl }}" alt="{{ $siteName }}">
                            <p class="h6 fw-700 fz-24 mb-0 {{ $lightText ? 'text-white' : '' }}">{{ $logoText }}</p>
                        </a>
                    </div>
                </div>

                {{-- Desktop navigation --}}
                <div class="{{ $navCol }} d-none d-xl-flex {{ $navAlign }}">
                    <div class="at-main-menu {{ $lightText ? 'menu-light' : '' }} d-inline-flex {{ $navAlign }}">
                        <nav>
                            {!! Menu::renderMenuLocation('main-menu', [
                                'view' => 'main-menu',
                                'options' => ['class' => ''],
                            ]) !!}
                        </nav>
                    </div>
                </div>

                {{-- Header right controls --}}
                <div class="{{ $rightCol }} col-6">
                    @include(Theme::getThemeNamespace('partials.header.right-controls'), ['isDark' => $lightText])
                </div>
            </div>
        </div>
    </div>

    {{-- Sticky hamburger button --}}
    @include(Theme::getThemeNamespace('partials.header.sticky-menu-btn'))
</header>
