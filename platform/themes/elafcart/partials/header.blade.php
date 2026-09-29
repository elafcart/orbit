<header class="portfolio-header" id="portfolioHeader">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand portfolio-logo" href="{{ url('/') }}">
                @if(theme_option('logo'))
                    <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title', 'Portfolio') }}" height="32">
                @else
                    <span class="logo-icon">◧</span>
                    <span class="logo-text">{{ theme_option('site_title', 'folio.') }}</span>
                @endif
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#portfolioNav" aria-controls="portfolioNav" aria-expanded="false">
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
                <span class="toggler-line"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="portfolioNav">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    {!! Menu::renderMenuLocation('main-menu', ['view' => 'menu', 'options' => ['class' => 'navbar-nav']]) !!}
                    
                    <div class="nav-actions ms-lg-4 d-flex align-items-center gap-2">
                        <!-- Language Switcher -->
                        @if(is_plugin_active('language'))
                            @php
                                $supportedLocales = Language::getSupportedLocales();
                                $currentLocale = Language::getCurrentLocale();
                                $languageDisplay = setting('language_display', 'all');
                            @endphp
                            @if($supportedLocales && count($supportedLocales) > 1)
                                <div class="language-switcher dropdown">
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if($languageDisplay == 'all' || $languageDisplay == 'flag')
                                            {!! language_flag($supportedLocales[$currentLocale]['lang_flag'] ?? '', $supportedLocales[$currentLocale]['lang_name'] ?? '') !!}
                                        @endif
                                        <span class="ms-1">{{ $supportedLocales[$currentLocale]['lang_name'] ?? $currentLocale }}</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @foreach($supportedLocales as $localeCode => $properties)
                                            <li>
                                                <a class="dropdown-item {{ $localeCode == $currentLocale ? 'active' : '' }}" 
                                                   href="{{ Language::getLocalizedURL($localeCode) }}">
                                                    @if($languageDisplay == 'all' || $languageDisplay == 'flag')
                                                        {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                                    @endif
                                                    @if($languageDisplay == 'all' || $languageDisplay == 'name')
                                                        {{ $properties['lang_name'] }}
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif

                        <!-- Cart Icon (Ecommerce) -->
                        @if(is_plugin_active('ecommerce'))
                            <a href="{{ route('public.cart') }}" class="btn btn-outline-secondary btn-sm rounded-circle position-relative" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-bag"></i>
                                @if(Cart::instance('cart')->count() > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.6rem;">
                                        {{ Cart::instance('cart')->count() }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        @if(theme_option('social_linkedin') || theme_option('social_github'))
                            <div class="social-links d-none d-lg-flex">
                                @if(theme_option('social_github'))
                                    <a href="{{ theme_option('social_github') }}" target="_blank" class="social-link"><i class="bi bi-github"></i></a>
                                @endif
                                @if(theme_option('social_linkedin'))
                                    <a href="{{ theme_option('social_linkedin') }}" target="_blank" class="social-link"><i class="bi bi-linkedin"></i></a>
                                @endif
                            </div>
                        @endif
                        <a href="#contact" class="btn btn-primary btn-sm rounded-pill px-4">{{ __('Let\'s Talk') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Mobile Language Switcher -->
@if(is_plugin_active('language'))
    @php
        $supportedLocales = Language::getSupportedLocales();
        $currentLocale = Language::getCurrentLocale();
    @endphp
    @if($supportedLocales && count($supportedLocales) > 1)
        <div class="mobile-language-switcher d-lg-none bg-light border-top py-2">
            <div class="container">
                <div class="d-flex gap-2 overflow-auto">
                    @foreach($supportedLocales as $localeCode => $properties)
                        <a href="{{ Language::getLocalizedURL($localeCode) }}" 
                           class="btn btn-sm {{ $localeCode == $currentLocale ? 'btn-dark' : 'btn-outline-secondary' }} rounded-pill flex-shrink-0">
                            {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                            {{ $properties['lang_name'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif
