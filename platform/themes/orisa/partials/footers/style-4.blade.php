@php
    $siteName        = theme_option('site_title', config('app.name'));
    $phone           = theme_option('footer_phone');
    $phoneSecondary  = theme_option('footer_phone_secondary');
    $email           = theme_option('footer_email');
    $address         = theme_option('footer_address');
    $copyrightText   = Theme::getSiteCopyright();
    $sinceYear       = theme_option('footer_since_year');
    $footerBrandText = theme_option('footer_brand_text', $siteName);

    $socialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());

    $arrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none" aria-hidden="true"><path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor" /></svg>';

    $footerServices = is_plugin_active('portfolio')
        ? \Botble\Portfolio\Models\Service::query()->wherePublished()->limit(4)->get()
        : collect();
    $serviceTagsSetting = $footerServices->isEmpty() ? theme_option('footer_service_tags') : null;
    $serviceTags = $serviceTagsSetting ? array_map('trim', explode(',', $serviceTagsSetting)) : [];

    $cornerIconSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor" /></svg>';

    // Render the primary footer sidebar once and inspect the result. When the
    // customer has removed every widget from `footer_primary_sidebar`, the
    // hardcoded "Quick Links" heading should disappear with them instead of
    // sitting alone in an empty column.
    $primarySidebarHtml = dynamic_sidebar('footer_primary_sidebar');
    $hasPrimarySidebar = trim(strip_tags((string) $primarySidebarHtml)) !== '';
@endphp

{!! apply_filters('ads_render', null, 'footer_before', ['class' => 'my-2 text-center']) !!}

<footer class="container-2200">
    <div class="at-footer-area mp-footer-style pt-50 pb-0 bg-neutral-950 rounded-5 mx-lg-3 mx-2 changeless">
        <div class="container">
            <div class="row g-md-5 g-4 pb-45 mb-40">
                {{-- Huge brand title --}}
                @if ($footerBrandText)
                    <div class="col-12 text-center">
                        <h2 class="footer-4-connect-title fw-900 fz-200 text-white mb-0 text-scale-anim text-center text-nowrap">{!! BaseHelper::clean($footerBrandText) !!}<sup class="fz-80 fw-400">&reg;</sup></h2>
                    </div>
                @endif

                {{-- Email + address + phones --}}
                <div class="col-lg-5 col-md-6 d-flex flex-column justify-content-between gap-lg-5 gap-4">
                    @if ($email)
                        <h3 class="h4 text-white mb-5 fw-medium text-decoration-underline">
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </h3>
                    @endif
                    <div class="d-flex flex-wrap gap-lg-5 gap-4">
                        @if ($address)
                            <div class="d-flex flex-column">
                                <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{{ __('Base on') }}</span>
                                <p class="h6 text-white mb-2">
                                    <span class="text-white text-decoration-none">{!! BaseHelper::clean($address) !!}</span>
                                </p>
                            </div>
                        @endif
                        @if ($phone || $phoneSecondary)
                            <div class="d-flex flex-column">
                                <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{{ __('Tel') }}</span>
                                @if ($phone)
                                    <p class="h6 text-white mb-2">
                                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $phone) }}" class="text-white text-decoration-none">{{ $phone }}</a>
                                    </p>
                                @endif
                                @if ($phoneSecondary)
                                    <p class="h6 text-white mb-2">
                                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $phoneSecondary) }}" class="text-white text-decoration-none">{{ $phoneSecondary }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Follow us + socials --}}
                @if ($socialLinks->isNotEmpty())
                    <div class="col-lg-4 col-md-6 align-self-end">
                        <div class="at-footer-widget at-footer-link mb-2">
                            <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{{ __('Follow Us') }}</span>
                            <div class="at-hero-social">
                                @foreach ($socialLinks as $link)
                                    <a href="{{ $link->getUrl() }}" target="_blank" rel="noopener noreferrer">
                                        {{ $link->getName() }}
                                        {!! $arrowSvg !!}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Quick links — only rendered when the sidebar has at least one widget --}}
                @if ($hasPrimarySidebar)
                    <div class="col-lg-3 col-md-6 d-flex flex-column justify-content-between">
                        <div class="at-footer-widget alt-footer-link-item-wrap row">
                            <span class="d-block fz-font-label neutral-0 opacity-50 text-uppercase mb-3">{{ __('Quick Links') }}</span>
                            {!! $primarySidebarHtml !!}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Bottom bar --}}
            <div class="at-footer-copyright-area at-about-border pt-40 pb-40">
                <div class="row align-items-center g-3">
                    <div class="col-xl-2 col-lg-5">
                        <div class="at-footer-copyright-wrap text">
                            @if ($copyrightText)
                                <span class="at-footer-copyright">{!! BaseHelper::clean($copyrightText) !!}</span>
                            @endif
                        </div>
                    </div>

                    @if ($footerServices->isNotEmpty() || ! empty($serviceTags))
                        <div class="col-xl-7 col-lg-7">
                            <ul class="d-flex flex-wrap gap-lg-4 gap-3 ps-3">
                                @if ($footerServices->isNotEmpty())
                                    @foreach ($footerServices as $service)
                                        <li>
                                            <a href="{{ $service->url }}" class="at-btn at-btn-border-white border-0 ps-2 pe-2 py-0 common-white opacity-50 bg-transparent rounded-0">
                                                <span>
                                                    <span class="text-1">{{ $service->name }}</span>
                                                    <span class="text-2">{{ $service->name }}</span>
                                                </span>
                                                <i>{!! $cornerIconSvg !!}{!! $cornerIconSvg !!}</i>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach ($serviceTags as $tag)
                                        <li>
                                            <div class="at-btn at-btn-border-white border-0 ps-2 pe-2 py-0 common-white opacity-50 bg-transparent rounded-0">
                                                <span>
                                                    <span class="text-1">{!! BaseHelper::clean($tag) !!}</span>
                                                    <span class="text-2">{!! BaseHelper::clean($tag) !!}</span>
                                                </span>
                                                <i>{!! $cornerIconSvg !!}{!! $cornerIconSvg !!}</i>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endif

                    <div class="col-xl-3">
                        <div class="at-footer-copyright-wrap text-lg-end">
                            @if ($sinceYear)
                                <span class="at-footer-copyright">[ {{ __('Since :year', ['year' => $sinceYear]) }} ]</span>
                            @else
                                {!! dynamic_sidebar('footer_bottom_sidebar') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-neutral-0 pt-10"></div>
</footer>

{!! apply_filters('ads_render', null, 'footer_after', ['class' => 'my-2 text-center']) !!}
