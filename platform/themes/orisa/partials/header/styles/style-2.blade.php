{{-- Header Style 2: rounded card with topbar (matches index-4.html) --}}
@php
    $topbarAddress = theme_option('header_top_address');
    $topbarPhone = theme_option('header_top_phone');
    $topbarEmail = theme_option('header_top_email');
    $hasTopbar = theme_option('display_header_top') && ($topbarAddress || $topbarPhone || $topbarEmail);
    $topbarBackground = theme_option('header_top_background_color', '#1D1D1D');
    $topbarText = theme_option('header_top_text_color', '#FEFEFE');
@endphp
<header class="z-index-5 bg-neutral-50">
    @if($hasTopbar)
        <div class="container-2200">
            <div
                class="topbar header-top d-none d-md-block changeless mx-lg-3 mx-2"
                style="--header-top-bg: {{ $topbarBackground }}; --header-top-text: {{ $topbarText }};"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                @if($topbarAddress)
                                    <div class="date">
                                        <p class="fz-font-label my-0">{{ $topbarAddress }}</p>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center gap-4">
                                    @if($topbarPhone)
                                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $topbarPhone) }}" class="fz-font-label fw-500">
                                            <span>{{ $topbarPhone }}</span>
                                        </a>
                                    @endif
                                    @if($topbarEmail)
                                        <a href="mailto:{{ $topbarEmail }}" class="fz-font-body fw-500">
                                            <span>{{ $topbarEmail }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Main header card --}}
    <div class="container-2200">
        <div class="at-header-area at-header-spacing bg-neutral-0 rounded-4 mx-lg-3 mx-2 mt-3 border-100">
            <div class="container">
                <div class="row align-items-center">
                    {{-- Logo --}}
                    <div class="col-xxl-3 col-xl-auto col-lg-4 col-6">
                        <div class="at-header-logo">
                            <a href="{{ $homepageUrl }}">
                                <img data-width="30" src="{{ $logoUrl }}" alt="{{ $siteName }}">
                                <p class="h6 fw-700 fz-24 mb-0">{{ $logoText }}</p>
                            </a>
                        </div>
                    </div>

                    {{-- Desktop navigation (≥1200px only).
                         The `col-xl-*` classes matter. Without them the nav had no column
                         width between 1200px and 1399px, so logo (col-lg-4) + auto-width nav
                         + controls (col-lg-8) overflowed 12 columns and the row broke onto
                         three lines, inflating the header from 88px to 165px (ticket 4576446).
                         The designed 3/6/3 split is kept from xxl up, where it fits. In the
                         1200-1399 band it does not: the 6-column nav measures 530px against a
                         570px menu, so the last item wrapped. There the logo and the controls
                         size to their content and the nav takes the rest (~830px). --}}
                    <div class="col-xxl-6 col-xl d-none d-xl-flex justify-content-center">
                        <div class="at-main-menu d-inline-flex justify-content-center">
                            <nav>
                                {!! Menu::renderMenuLocation('main-menu', [
                                    'view' => 'main-menu',
                                    'options' => ['class' => ''],
                                ]) !!}
                            </nav>
                        </div>
                    </div>

                    {{-- Header right controls — col-lg-8 picks up the slack at 992–1199px when nav is hidden --}}
                    <div class="col-xxl-3 col-xl-auto col-lg-8 col-6">
                        @include(Theme::getThemeNamespace('partials.header.right-controls'), ['isDark' => false])
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sticky hamburger button --}}
    @include(Theme::getThemeNamespace('partials.header.sticky-menu-btn'))
</header>
