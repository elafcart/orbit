{{-- Hero Banner Style 2 — light/white bg, large brand title, social links, ripple image --}}
@php
    $arrowUpSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none"><path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor"/></svg>';
    $arrowDiagSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-hero-banner shortcode-hero-banner-style-2 sec-1-home-2 pt-85 container-2200">

    <div class="overflow-hidden p-relative pt-90 pb-90 mx-lg-3 mx-2">

        {{-- Noise overlay (decorative, rendered at opacity 10%) --}}
        @if($shortcode->noise_overlay)
            <div class="p-absolute top-0 left-0 w-100 h-100 rounded-5 opacity-10 z-0"
                data-background="{{ RvMedia::getImageUrl($shortcode->noise_overlay) }}"></div>
        @endif

        <div class="container p-relative z-1">
            <div class="row g-4 align-items-end">

                {{-- Ripple image --}}
                @if($shortcode->image)
                    <div class="col-xxl-2 col-md-4">
                        <div class="ripple-image ripples rounded-3 overflow-hidden">
                            {{ RvMedia::image($shortcode->image, $shortcode->title, attributes: ['class' => 'img-cover']) }}
                        </div>
                    </div>
                @endif

                {{-- Service description block --}}
                <div class="col-xxl-2 col-lg-5 col-md-6 col-12">
                    <div class="alt-hero-service at-hero-service mt-40">
                        <ul>
                            <li>
                                <svg class="common-black" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M30 20H20V30L20 40H10L0 30L10 20H0V0H10L20 10V1.90735e-06L30 0L40 10L30 20ZM20 10V20H10L20 10Z" fill="currentColor"/>
                                    <path d="M30 20H40V40H30L20 30L30 20Z" fill="currentColor"/>
                                </svg>
                            </li>
                            @if($shortcode->description)
                                <li>
                                    <span class="fz-font-md fw-500 common-black">{!! BaseHelper::clean($shortcode->description) !!}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- Brand title + social links --}}
                <div class="col-xxl-7 col-12 offset-xxl-1">
                    <div class="at-title-anim overflow-hidden">
                        @if($shortcode->title)
                            <{{ $titleTag }} class="fz-160 fw-600 mb-0 at-title-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                        @endif
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        {{-- Social links --}}
                        @if(count($socialLinks) > 0)
                            <div class="at-hero-social style-2">
                                @foreach($socialLinks as $link)
                                    <a href="{{ $link['url'] }}">
                                        {{ $link['name'] }}
                                        {!! $arrowUpSvg !!}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        @if($shortcode->subtitle)
                            <p class="fz-font-lg fw-500 mb-0">[ {!! BaseHelper::clean($shortcode->subtitle) !!} ]</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Bottom video / image section with service tabs --}}
    @if($shortcode->primary_action_label || count($services) > 0)
        <div class="bg-coating rounded-5 overflow-hidden mx-lg-3 mx-2 bg-cover"
            @if($shortcode->background_image) data-background="{{ RvMedia::getImageUrl($shortcode->background_image) }}" @endif>

            @if($shortcode->background_video)
                <video src="{{ $shortcode->background_video }}" autoplay muted loop
                    class="img-cover p-absolute top-0 start-0 end-0 bottom-0 z-0"></video>
            @endif

            {{-- Service tabs row (top of dark strip) --}}
            <div class="container pb-100 p-relative z-index-2">
                <div class="row">
                    @if($shortcode->primary_action_label)
                        <div class="col-lg-3 col-md-6 col-12 text-center">
                            <a class="at-btn at-btn-border-white ps-2 pt-20 pb-20 pe-2 text-white bg-transparent rounded-0 border-top-0 border-start-0 border-end-0 w-100"
                                href="{{ $shortcode->primary_action_url }}">
                                <span>
                                    <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                                </span>
                                <i>{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                            </a>
                        </div>
                    @endif
                    @foreach($services as $service)
                        <div class="col-lg-3 col-md-6 col-12 text-center">
                            <div class="at-btn at-btn-border-white ps-2 pt-20 pb-20 pe-2 text-white bg-transparent rounded-0 border-top-0 border-start-0 border-end-0 w-100">
                                <span>
                                    <span class="text-1">{{ $service['name'] }}</span>
                                    <span class="text-2">{{ $service['name'] }}</span>
                                </span>
                                <i>{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Who We Are content row (bottom of dark strip) --}}
            @if($shortcode->bottom_title || $shortcode->card_image)
                <div class="container pb-100 p-relative z-index-2">
                    <div class="row g-4 justify-content-lg-between justify-content-center align-items-end">
                        @if($shortcode->bottom_title || $shortcode->bottom_subtitle || $shortcode->bottom_description)
                            <div class="col-lg-5 col-12">
                                <div class="at-about-title-wrap">
                                    @if($shortcode->bottom_subtitle)
                                        <span class="at-btn text-white bg-transparent mb-10 rounded-0 p-0">
                                            <span class="text-uppercase">
                                                <span class="text-1">{!! BaseHelper::clean($shortcode->bottom_subtitle) !!}</span>
                                                <span class="text-2">{!! BaseHelper::clean($shortcode->bottom_subtitle) !!}</span>
                                            </span>
                                            <i>{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                                        </span>
                                    @endif

                                    @if($shortcode->bottom_title)
                                        <h2 class="at-section-title reveal-text text-white lh-1 mb-40 mt-20">
                                            {!! BaseHelper::clean($shortcode->bottom_title) !!}
                                        </h2>
                                    @endif

                                    @if($shortcode->bottom_description)
                                        <p class="text-white mb-0">{!! BaseHelper::clean($shortcode->bottom_description) !!}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($shortcode->card_image)
                            <div class="col-xxl-3 col-lg-4 col-md-7 tp_fade-anim">
                                <div class="card-item p-relative at_fade_anim" data-fade-from="bottom" data-duration="1" data-delay="0.5">
                                    <div class="card-item__bg">
                                        <img src="{{ RvMedia::getImageUrl($shortcode->card_image) }}" alt="{{ $shortcode->card_text ?? '' }}" class="home-2-card-item__bg-img img-cover">
                                    </div>
                                    @if($shortcode->card_avatar)
                                        <div class="card-item-avatar p-absolute top-0 end-0 changeless">
                                            <img src="{{ RvMedia::getImageUrl($shortcode->card_avatar) }}" alt="Profile" class="home-2-card-item__avatar-img">
                                        </div>
                                    @endif
                                    @if($shortcode->card_text)
                                        <div class="card-item-content p-absolute bottom-0 start-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M40 20V0H20H0V20V40H20L40 20ZM40 20H20V40L0 20L20 0L40 20Z" fill="#FEFEFE"/>
                                            </svg>
                                            <h3 class="h6 card-item-text mb-0 text-white">
                                                {!! BaseHelper::clean($shortcode->card_text) !!}
                                            </h3>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif

</div>
