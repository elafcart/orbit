{{-- Hero Banner Style 1 — dark bg with data-background, video, service tags, social email --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $heroEmail = theme_option('offcanvas_email', 'hello@orisa.com');
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-hero-banner shortcode-hero-banner-style-1 at-hero-area scene p-relative z-index-1 bg-position fix at-hero-spacing bg-primary-1"
    @if($shortcode->background_image) data-background="{{ RvMedia::getImageUrl($shortcode->background_image) }}" @endif>

    {{-- Hero background image --}}
    @if($shortcode->image)
        <div class="at-hero-bg at_fade_anim" data-speed=".8" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
            {{ RvMedia::image($shortcode->image, $shortcode->title, attributes: [
                'class' => 'layer',
                'data-depth' => '0.8',
                'loading' => 'eager',
                'fetchpriority' => 'high',
                'decoding' => 'async',
            ], lazy: false) }}
        </div>
    @endif

    <div class="container p-relative">

        {{-- Email badge (bottom-left floating) --}}
        <div class="p-absolute bottom-100 start-0 ms-5 mb-100 d-none d-lg-block">
            <a href="mailto:{{ $heroEmail }}" class="at-hero-button at-btn bg-transparent p-relative">
                <img src="{{ Theme::asset()->url('images/icons/badge-1.svg') }}" alt="{{ config('app.name') }}">
                <span class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center">
                    <i class="text-white">
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                    </i>
                    <span class="mt-2">
                        <span class="fw-700 text-white">{{ __("Let's Talk") }}</span>
                    </span>
                </span>
            </a>
        </div>

        <div class="row align-items-end">

            {{-- Video block --}}
            <div class="col-xxl-2 col-xl-2 col-lg-4 col-md-5">
                <div class="at-hero-video mb-30 at_fade_anim">
                    @if($shortcode->background_video)
                        <div class="rounded-3 overflow-hidden">
                            <video class="img-cover" autoplay muted loop playsinline>
                                <source src="{{ $shortcode->background_video }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                    @if($shortcode->secondary_action_label)
                        <a class="at-btn text-white rounded-0 bg-transparent px-0 pt-2 pb-3 border-0" href="{{ $shortcode->secondary_action_url }}">
                            <span>
                                <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                            </span>
                            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Service / description block --}}
            <div class="col-xxl-2 col-xl-3 col-lg-5 col-md-5">
                <div class="alt-hero-service at-hero-service mb-30">
                    <ul>
                        <li class="pb-10 at_fade_anim">
                            @if($shortcode->service_icon)
                                {{ RvMedia::image($shortcode->service_icon, $shortcode->title, attributes: ['width' => 40, 'height' => 40]) }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30 20H20V30L20 40H10L0 30L10 20H0V0H10L20 10V1.90735e-06L30 0L40 10L30 20ZM20 10V20H10L20 10Z" fill="white"/>
                                    <path d="M30 20H40V40H30L20 30L30 20Z" fill="white"/>
                                </svg>
                            @endif
                        </li>
                        @if($shortcode->description)
                            <li class="at_fade_anim">
                                <span class="fz-font-md fw-500 text-white">{!! BaseHelper::clean($shortcode->description) !!}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Hero title & CTA block --}}
            <div class="col-xxl-5 offset-xxl-2 col-xl-6 col-12 ms-auto order-xl-1 order-md-2">
                <div class="at-hero-content mb-30">
                    @if($shortcode->subtitle)
                        <span class="at-hero-subtitle text-white mb-10 d-inline-block at_fade_anim">
                            {!! BaseHelper::clean($shortcode->subtitle) !!}
                        </span>
                    @endif
                    @if($shortcode->title)
                        <{{ $titleTag }} class="at-hero-title text-white {{ $titleSizeClass }}">
                            <span class="at_fade_anim" data-delay="0.5" data-fade-from="top">
                                {!! BaseHelper::clean($shortcode->title) !!}
                            </span>
                        </{{ $titleTag }}>
                    @endif
                    <div class="at-hero-btn d-flex flex-wrap gap-2 pt-20 at_fade_anim" data-delay="0.5" data-fade-from="bottom">
                        @if($shortcode->primary_action_label)
                            <a class="at-btn bg-white rounded-0 text-dark" href="{{ $shortcode->primary_action_url }}">
                                <span>
                                    <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </a>
                        @endif
                        @if($shortcode->secondary_action_label)
                            <a class="at-btn at-btn-border-white text-white rounded-0" href="{{ $shortcode->secondary_action_url }}">
                                <span>
                                    <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Rotated email link --}}
            <div class="col-1 ms-auto text-end align-self-start rotate-90 order-xl-2 order-md-1 d-none d-md-block">
                <a href="mailto:{{ $heroEmail }}" class="text-white fw-600">
                    <span class="at_fade_anim">{{ $heroEmail }}</span>
                </a>
            </div>
        </div>

        {{-- Bottom service tags row --}}
        @if(count($services) > 0)
            <div class="row pt-60 at_fade_anim">
                <div class="col-xxl-8 col-xl-9 mx-auto">
                    <div class="border-bottom border-white opacity-25 mb-20"></div>
                    <div class="at-hero-service-2">
                        <ul class="d-flex flex-wrap justify-content-lg-between justify-content-around gap-lg-4 gap-2 ps-3">
                            @foreach($services as $service)
                                <li>
                                    <div class="at-btn border-0 ps-2 py-0 pe-2 text-white bg-transparent rounded-0">
                                        <span>
                                            <span class="text-1">{{ $service['name'] }}</span>
                                            <span class="text-2">{{ $service['name'] }}</span>
                                        </span>
                                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
