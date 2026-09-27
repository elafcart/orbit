@php
    $siteName    = theme_option('site_title', config('app.name'));
    $logoUrl     = theme_option('logo') ? RvMedia::getImageUrl(theme_option('logo')) : Theme::asset()->url('images/logo/favicon-dark.svg');
    $phone       = theme_option('footer_phone');
    $email       = theme_option('footer_email');
    $address     = theme_option('footer_address');
    $copyrightText = Theme::getSiteCopyright();

    $connectTitle = theme_option('footer_connect_title', __("Let's Connect"));
    $hoursLabel   = theme_option('footer_hours_label', __('Mo - Sa'));
    $hoursValue   = theme_option('footer_hours_value', __('9am - 5pm'));

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

<footer class="footer-fixed-bottom bg-neutral-950 changeless">
    <div class="at-footer-area mp-footer-style mp-footer-style-2 pt-120 pb-0">
        <div class="container">

            {{-- Top section: Logo + Contact | Nav | Follow Us + Social --}}
            <div class="row g-5 pb-md-5 pb-2">
                <div class="col-lg-4">
                    <div class="d-flex flex-wrap align-items-start gap-5">
                        <div class="at-header-logo">
                            <a href="{{ url('/') }}">
                                <img data-width="30" src="{{ $logoUrl }}" alt="{{ $siteName }}">
                                <p class="h6 fw-700 text-white mb-0 fz-24">{{ $siteName }}</p>
                            </a>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            @if ($phone)
                                <p class="h6 text-white mb-2 fw-medium">{{ $phone }}</p>
                            @endif
                            @if ($email)
                                <p class="h6 text-white mb-2">
                                    <a href="mailto:{{ $email }}" class="text-white text-decoration-none">{{ $email }}</a>
                                </p>
                            @endif
                            @if ($address)
                                <p class="h6 text-white mb-0">{!! BaseHelper::clean($address) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="at-footer-widget alt-footer-link-item-wrap row">
                        {!! dynamic_sidebar('footer_primary_sidebar') !!}
                    </div>
                </div>

                @if ($socialLinks->isNotEmpty())
                    <div class="col-lg-3 col-md-6 flex-column justify-content-lg-end d-none d-md-flex">
                        <p class="footer-2-follow-label text-white opacity-50 text-uppercase small mb-3">{{ __('Follow Us') }}</p>
                        <div class="at-footer-widget at-footer-link">
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
            </div>

            {{-- Bottom section: Copyright + Let's Connect | Hours | Service tags --}}
            <div class="footer-2-border pt-40 pb-40">
                <div class="row align-items-end g-4">
                    <div class="col-lg-10 col-md-8">
                        @if ($copyrightText)
                            <span class="at-footer-copyright">{!! BaseHelper::clean($copyrightText) !!}</span>
                        @endif
                        @if ($connectTitle)
                            <div class="at-title-anim overflow-hidden">
                                <h2 class="footer-2-connect-title text-white mb-0 at-title-text text-scale-anim">{!! BaseHelper::clean($connectTitle) !!}</h2>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-2 col-md-4 text-end">
                        <div class="d-flex flex-wrap align-items-end gap-4 gap-md-5 mb-3">
                            <div class="footer-2-hours text-white">
                                @if ($hoursLabel)
                                    <span class="d-block fz-font-md opacity-50">{{ $hoursLabel }}</span>
                                @endif
                                @if ($hoursValue)
                                    <h3 class="h5 fw-400 common-white">{{ $hoursValue }}</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if ($footerServices->isNotEmpty() || ! empty($serviceTags))
                    <div class="row d-none d-md-block">
                        <div class="col-12">
                            <ul class="d-flex flex-wrap gap-lg-4 gap-2 ps-3 pt-4 pb-2">
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
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>

{!! apply_filters('ads_render', null, 'footer_after', ['class' => 'my-2 text-center']) !!}
