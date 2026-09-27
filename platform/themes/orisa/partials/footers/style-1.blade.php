@php
    $siteName         = theme_option('site_title', config('app.name'));
    $logoUrl          = theme_option('logo') ? RvMedia::getImageUrl(theme_option('logo')) : Theme::asset()->url('images/logo/favicon-dark.svg');
    $phone            = theme_option('footer_phone');
    $email            = theme_option('footer_email');
    $address          = theme_option('footer_address');
    $footerBrandText  = theme_option('footer_brand_text');
    $copyrightYear    = date('Y');
    $copyrightText    = Theme::getSiteCopyright();

    $socialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());

    $arrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none" aria-hidden="true"><path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor" /></svg>';

    $footerServices = is_plugin_active('portfolio')
        ? \Botble\Portfolio\Models\Service::query()->wherePublished()->limit(4)->get()
        : collect();
    $serviceTagsSetting = $footerServices->isEmpty() ? theme_option('footer_service_tags') : null;
    $serviceTags = $serviceTagsSetting ? array_map('trim', explode(',', $serviceTagsSetting)) : [];

    $cornerIconSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor" /></svg>';
@endphp

{!! apply_filters('ads_render', null, 'footer_before', ['class' => 'my-2 text-center']) !!}

<footer class="container-2200">
    <div class="at-footer-area mp-footer-style pt-60 bg-neutral-950 rounded-5 mx-lg-3 mx-2 changeless">
        <div class="container">

            {{-- Top row: logo/address + contact/social --}}
            <div class="row g-5">
                <div class="col-xxl-4 col-lg-6">
                    <div class="d-flex flex-wrap align-items-start gap-4">
                        <img class="mt-5" data-width="50" src="{{ $logoUrl }}" alt="{{ $siteName }}">
                        <div>
                            @if(theme_option('footer_heading'))
                                <h3 class="h4 text-white reveal-text">
                                    {!! BaseHelper::clean(theme_option('footer_heading')) !!}
                                </h3>
                            @endif
                            @if ($address)
                                <p class="mb-0">{!! BaseHelper::clean($address) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-lg-5 col-md-8 ms-lg-auto text-lg-end">
                    <div class="at-footer-title-wrap">
                        @if ($phone)
                            <h4 class="h6 text-white">{{ $phone }}</h4>
                        @endif
                        @if ($email)
                            <h5 class="h4 text-white text-decoration-underline text-wrap">{{ $email }}</h5>
                        @endif

                        @if ($socialLinks->isNotEmpty())
                            <div class="at-footer-widget at-footer-link pt-50">
                                <div class="at-hero-social justify-content-lg-end">
                                    @foreach ($socialLinks as $link)
                                        <a href="{{ $link->getUrl() }}" target="_blank" rel="noopener noreferrer">
                                            {{ $link->getName() }}
                                            {!! $arrowSvg !!}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Navigation + brand text --}}
            <div class="at-about pt-100 pb-60 p-relative">
                <div class="row align-items-end g-5">
                    <div class="col-xxl-3 col-lg-4 col-md-6">
                        <div class="at-footer-widget alt-footer-link-item-wrap row">
                            {!! dynamic_sidebar('footer_primary_sidebar') !!}
                        </div>
                    </div>

                    @if($footerBrandText)
                        <div class="col-xxl-9 col-lg-8 col-12 text-lg-end">
                            {{-- Footer brand text uses <p class="h1"> rather than a real <h1> so each page only emits one semantic H1 (the page-content one). The h1 class preserves the visual size; matches the style-5 footer pattern. --}}
                            <p class="h1 fz-160 common-white mb-0 text-scale-anim">{!! BaseHelper::clean($footerBrandText) !!}<sup class="fz-80 fw-400">®</sup></p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Copyright bar --}}
            <div class="at-footer-copyright-area at-about-border pt-40 pb-40">
                <div class="row align-items-center g-3">
                    <div class="col-lg-2">
                        <div class="at-footer-copyright-wrap text">
                            @if($copyrightText)
                            <span class="at-footer-copyright">{!! BaseHelper::clean($copyrightText) !!}</span>
                        @endif
                        </div>
                    </div>

                    @if ($footerServices->isNotEmpty())
                        <div class="col-lg-8">
                            <ul class="d-flex flex-wrap gap-lg-4 gap-3 ps-3">
                                @foreach ($footerServices as $service)
                                    <li>
                                        <a href="{{ $service->url }}" class="at-btn border-0 ps-2 pe-2 py-0 common-white opacity-50 bg-transparent rounded-0">
                                            <span>
                                                <span class="text-1">{{ $service->name }}</span>
                                                <span class="text-2">{{ $service->name }}</span>
                                            </span>
                                            <i>{!! $cornerIconSvg !!}{!! $cornerIconSvg !!}</i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif ($serviceTags)
                        <div class="col-lg-8">
                            <ul class="d-flex flex-wrap gap-lg-4 gap-3 ps-3">
                                @foreach ($serviceTags as $tag)
                                    <li>
                                        <div class="at-btn border-0 ps-2 pe-2 py-0 common-white opacity-50 bg-transparent rounded-0">
                                            <span>
                                                <span class="text-1">{!! BaseHelper::clean($tag) !!}</span>
                                                <span class="text-2">{!! BaseHelper::clean($tag) !!}</span>
                                            </span>
                                            <i>{!! $cornerIconSvg !!}{!! $cornerIconSvg !!}</i>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-lg-2">
                        <div class="at-footer-copyright-wrap text-lg-end">
                            @php $sinceYear = theme_option('footer_since_year'); @endphp
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
