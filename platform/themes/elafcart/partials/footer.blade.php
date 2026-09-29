<footer class="portfolio-footer">
    <div class="container">
        <div class="footer-top">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="footer-cta-title">{{ __('Have an idea?') }}<br><span class="text-primary">{{ __('Let\'s build it together!') }}</span></h2>
                </div>
                <div class="col-lg-6 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ theme_option('footer_cta_link', '#contact') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                        {{ theme_option('footer_cta_text', __('Get In Touch')) }} <i class="bi bi-arrow-up-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-main">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <h4 class="footer-logo">{{ theme_option('site_title', 'folio.') }}</h4>
                        <p class="footer-desc mt-3">{{ theme_option('site_description', __('Crafting digital experiences that matter. Full-stack developer based in Dhaka, Bangladesh.')) }}</p>
                        <div class="footer-social mt-4">
                            @if(theme_option('social_github'))<a href="{{ theme_option('social_github') }}" target="_blank"><i class="bi bi-github"></i></a>@endif
                            @if(theme_option('social_linkedin'))<a href="{{ theme_option('social_linkedin') }}" target="_blank"><i class="bi bi-linkedin"></i></a>@endif
                            @if(theme_option('social_twitter'))<a href="{{ theme_option('social_twitter') }}" target="_blank"><i class="bi bi-twitter-x"></i></a>@endif
                            @if(theme_option('social_dribbble'))<a href="{{ theme_option('social_dribbble') }}" target="_blank"><i class="bi bi-dribbble"></i></a>@endif
                            @if(theme_option('social_behance'))<a href="{{ theme_option('social_behance') }}" target="_blank"><i class="bi bi-behance"></i></a>@endif
                        </div>

                        <!-- Language Switcher in Footer -->
                        @if(is_plugin_active('language'))
                            @php
                                $supportedLocales = Language::getSupportedLocales();
                                $currentLocale = Language::getCurrentLocale();
                            @endphp
                            @if($supportedLocales && count($supportedLocales) > 1)
                                <div class="footer-language mt-4">
                                    <h6 class="footer-widget-title">{{ __('Language') }}</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($supportedLocales as $localeCode => $properties)
                                            <a href="{{ Language::getLocalizedURL($localeCode) }}" 
                                               class="btn btn-sm {{ $localeCode == $currentLocale ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill">
                                                {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                                {{ $properties['lang_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="footer-widget-title">{{ __('Navigation') }}</h6>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                        <li><a href="{{ url('/#about') }}">{{ __('About') }}</a></li>
                        <li><a href="{{ url('/#projects') }}">{{ __('Projects') }}</a></li>
                        <li><a href="{{ url('/#services') }}">{{ __('Services') }}</a></li>
                        <li><a href="{{ url('/blog') }}">{{ __('Blog') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="footer-widget-title">{{ __('Services') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('Web Development') }}</a></li>
                        <li><a href="#">{{ __('UI/UX Design') }}</a></li>
                        <li><a href="#">{{ __('E-commerce') }}</a></li>
                        <li><a href="#">{{ __('Consulting') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-widget-title">{{ __('Contact') }}</h6>
                    <ul class="footer-contact">
                        <li><i class="bi bi-envelope"></i> {{ theme_option('email', 'hello@elafcart.com') }}</li>
                        <li><i class="bi bi-telephone"></i> {{ theme_option('phone', '+880 1XXX-XXXXXX') }}</li>
                        <li><i class="bi bi-geo-alt"></i> {{ theme_option('address', 'Dhaka, Bangladesh') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-0">{!! theme_option('copyright', '© ' . date('Y') . ' ' . __('All rights reserved. Built with ❤️')) !!}</p>
                </div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                    <div class="footer-bottom-links">
                        <a href="#">{{ __('Privacy') }}</a>
                        <a href="#">{{ __('Terms') }}</a>
                        <a href="#">{{ __('Sitemap') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
