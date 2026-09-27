@php
    $siteName       = theme_option('site_title', config('app.name'));
    // Prefer the concise logo_text ("Orisa") for the huge brand H1 — site_title may be a full
    // descriptive string like "Orisa — Marketing Agency" that wraps awkwardly at fz-120.
    $brandName      = theme_option('logo_text') ?: theme_option('footer_brand_text') ?: 'Orisa';
    $phone          = theme_option('footer_phone');
    $email          = theme_option('footer_email');
    $address        = theme_option('footer_address');
    $copyrightText  = Theme::getSiteCopyright();
    $sinceYear      = theme_option('footer_since_year');

    $hoursLabel     = theme_option('footer_hours_label', __('Mo - Sa'));
    $hoursValue     = theme_option('footer_hours_value', __('9am - 5pm'));
    $promoBadge     = theme_option('footer_promo_badge', __('GET 20% OFF'));
    $connectTitle   = theme_option('footer_connect_title', __('PURE PERFORMANCE'));

    $socialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());

    $arrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none" aria-hidden="true"><path d="M7.60201e-05 6.26559L0 2.03894e-05L1.49997 -4.58971e-07L1.50004 4.87322L9.12873 4.87329L6.16652 2.12355L7.22714 1.139L12 5.56948L7.22713 10L6.16652 9.01545L9.12876 6.26566L7.60201e-05 6.26559Z" fill="currentColor" /></svg>';
@endphp

{!! apply_filters('ads_render', null, 'footer_before', ['class' => 'my-2 text-center']) !!}

<footer>
    <div class="at-footer-area mp-footer-style pt-120 pb-0 bg-neutral-950 changeless">
        <div class="container">
            <div class="row g-5 pb-45">
                {{-- Brand column --}}
                <div class="col-lg-3 col-md-8">
                    <div class="footer-3-logo">
                        {{-- Kept `fz-120` base size but removed `text-scale-anim` — the theme's
                             GSAP ScrollTrigger over-scales brand text here, making it overflow
                             the column. The `PURE PERFORMANCE` h2 below still uses text-scale-anim
                             where it behaves correctly. --}}
                        {{-- Footer brand uses <p class="h1"> rather than a real <h1> so each page only emits one semantic H1 (the page-content one). The h1 class preserves the visual size; matches the style-5 footer pattern. --}}
                        <p class="h1 fz-120 mb-0 text-white fw-500 lh-1">
                            <a href="{{ url('/') }}" class="text-white text-decoration-none">{{ $brandName }}<sup class="fz-60 fw-400">&reg;</sup></a>
                        </p>
                    </div>
                    @if ($socialLinks->isNotEmpty())
                        <div class="alt-footer-social-item w-75 pt-50">
                            <ul>
                                @foreach ($socialLinks as $link)
                                    <li>
                                        <a href="{{ $link->getUrl() }}" target="_blank" rel="noopener noreferrer" class="text-white">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-social">
                                                    <x-core::icon :name="$link->getIcon()" />
                                                </div>
                                                <span>{{ $link->getName() }}</span>
                                            </div>
                                            {!! $arrowSvg !!}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Hours + promo --}}
                <div class="col-lg-2 col-md-4 col-10 align-self-end">
                    <div class="d-flex flex-wrap align-items-end gap-3 gap-md-5 mb-50">
                        <div class="footer-3-hours text-white">
                            @if ($hoursLabel)
                                <span class="d-block fz-font-md opacity-50">{{ $hoursLabel }}</span>
                            @endif
                            @if ($hoursValue)
                                <p class="h5 fw-400 common-white mb-0">{{ $hoursValue }}</p>
                            @endif
                        </div>
                        @if ($promoBadge)
                            <div class="sale-off">{{ $promoBadge }}</div>
                        @endif
                    </div>
                </div>

                {{-- Get in touch + Office --}}
                <div class="col-lg-3 col-md-6 me-auto">
                    <div class="d-flex flex-column gap-3">
                        <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase">{{ __('Get in Touch') }}</span>
                        @if ($phone)
                            <p class="h6 text-white mb-2 fw-medium">
                                <a href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}" class="text-white text-decoration-none">{{ $phone }}</a>
                            </p>
                        @endif
                        @if ($email)
                            <p class="h6 text-white mb-2">
                                <a href="mailto:{{ $email }}" class="text-white text-decoration-none">{{ $email }}</a>
                            </p>
                        @endif
                    </div>
                    @if ($address)
                        <div class="d-flex flex-column gap-3 mt-60">
                            <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase">{{ __('Office') }}</span>
                            <p class="h6 text-white mb-2">
                                <span class="text-white text-decoration-none">{!! BaseHelper::clean($address) !!}</span>
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Quick links --}}
                <div class="col-lg-3 col-md-6 d-flex flex-column justify-content-between">
                    <div class="at-footer-widget alt-footer-link-item-wrap row">
                        <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{{ __('Quick Links') }}</span>
                        {!! dynamic_sidebar('footer_primary_sidebar') !!}
                    </div>
                </div>
            </div>

            {{-- Bottom row: copyright + policy links + huge connect title --}}
            @php
                // Parse optional footer_bottom_links JSON or fallback to default policy list.
                $bottomLinks = theme_option('footer_bottom_links')
                    ? json_decode(theme_option('footer_bottom_links'), true)
                    : [
                        ['label' => __('Privacy Policy'), 'url' => '#'],
                        ['label' => __('Terms of Use'), 'url' => '#'],
                        ['label' => __('Refund Policy'), 'url' => '#'],
                    ];
            @endphp
            <div class="footer-3-border pt-40 pb-40">
                <div class="row align-items-end">
                    <div class="col-12">
                        <div class="at-footer-widget alt-footer-link-item-wrap border-top-opacity pt-4">
                            <div class="alt-footer-link-item">
                                <ul class="d-flex flex-wrap align-items-center justify-content-between text-center gap-1 list-unstyled mb-0">
                                    @if ($copyrightText)
                                        <li><span class="fz-font-md neutral-0 opacity-50">{!! BaseHelper::clean($copyrightText) !!}</span></li>
                                    @endif
                                    @foreach($bottomLinks as $bl)
                                        <li>
                                            <a href="{{ $bl['url'] ?? '#' }}" class="fz-font-md neutral-0 opacity-50 text-decoration-none">{{ $bl['label'] ?? '' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @if ($connectTitle)
                                <h2 class="footer-3-connect-title fw-900 fz-170 text-white mb-0 text-scale-anim text-center py-4">{!! BaseHelper::clean($connectTitle) !!}</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{!! apply_filters('ads_render', null, 'footer_after', ['class' => 'my-2 text-center']) !!}
