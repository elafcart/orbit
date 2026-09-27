{{-- Header Style 3: narrow rounded card, centered nav, no topbar (matches index-5.html) --}}
<header>
    <div class="container-1136 at-header-spacing bg-neutral-0 rounded-4 mt-3 border-100 mx-xxl-auto mx-lg-3 mx-2 p-relative z-index-10">
        <div class="container">
            <div class="row align-items-center">
                {{-- Logo --}}
                <div class="col-xl-2 col-6">
                    <div class="at-header-logo px-2">
                        <a href="{{ $homepageUrl }}">
                            <img data-width="30" src="{{ $logoUrl }}" alt="{{ $siteName }}">
                            <p class="h6 fw-700 fz-24 mb-0">{{ $logoText }}</p>
                        </a>
                    </div>
                </div>

                {{-- Desktop navigation --}}
                <div class="col-xl-7 mx-auto d-none d-xl-block">
                    <div class="at-main-menu d-inline-flex justify-content-center">
                        <nav>
                            {!! Menu::renderMenuLocation('main-menu', [
                                'view' => 'main-menu',
                                'options' => ['class' => ''],
                            ]) !!}
                        </nav>
                    </div>
                </div>

                {{-- Header right controls --}}
                <div class="col-xl-2 col-6">
                    @include(Theme::getThemeNamespace('partials.header.right-controls'), ['isDark' => false])
                </div>
            </div>
        </div>
    </div>

    {{-- Sticky hamburger button --}}
    @include(Theme::getThemeNamespace('partials.header.sticky-menu-btn'))
</header>
