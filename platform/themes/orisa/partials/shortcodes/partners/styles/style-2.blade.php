{{-- Partners Style 2 — Home 2 section with title, carousel ticker, and CTA badge --}}
@php
    $arrowDiagSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-3-home-2 pt-130 pb-130">
    <div class="container">
        <div class="row">
            @if($shortcode->title || $shortcode->subtitle)
                <div class="col-lg-9 col-12">
                    <div class="at-about-title-wrap d-flex flex-wrap flex-lg-nowrap align-items-start gap-4 mb-30">
                        @if($shortcode->subtitle)
                            <span class="at-btn common-black bg-transparent rounded-0 p-0 mt-xxl-2">
                                <span class="text-uppercase text-nowrap">
                                    <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                    <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                </span>
                                <i>{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                            </span>
                        @endif
                        @if($shortcode->title)
                            <{{ $titleTag }} class="at-section-title reveal-text {{ $titleSizeClass }}">
                                {!! BaseHelper::clean($shortcode->title) !!}
                            </{{ $titleTag }}>
                        @endif
                    </div>
                </div>
            @endif

            @if(!empty($partners))
                <div class="col-lg-11 col-12 ms-auto at-brand-area border-0">
                    <div class="carouselTicker carouselTicker-left position-relative z-1">
                        <ul class="carouselTicker__list">
                            @foreach($partners as $partner)
                                <li class="carouselTicker__item">
                                    <div class="brand-item dark-mode-invert">
                                        @if(!empty($partner['url']))
                                            <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
                                                {{ RvMedia::image($partner['image'], $partner['name'] ?? 'logo-brand') }}
                                            </a>
                                        @else
                                            {{ RvMedia::image($partner['image'], $partner['name'] ?? 'logo-brand') }}
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                            {{-- Duplicate items for seamless infinite scroll --}}
                            @foreach($partners as $partner)
                                <li class="carouselTicker__item">
                                    <div class="brand-item dark-mode-invert">
                                        @if(!empty($partner['url']))
                                            <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
                                                {{ RvMedia::image($partner['image'], $partner['name'] ?? 'logo-brand') }}
                                            </a>
                                        @else
                                            {{ RvMedia::image($partner['image'], $partner['name'] ?? 'logo-brand') }}
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if($shortcode->primary_action_label || $shortcode->description)
                <div class="col-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-center">
                        @if($shortcode->primary_action_label)
                            <a href="{{ $shortcode->primary_action_url ?: '#' }}" class="at-btn bg-transparent p-relative">
                                <img src="{{ Theme::asset()->url('images/icons/badge-1.svg') }}" alt="{{ Theme::getSiteName() }}">
                                <span class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center">
                                    <i class="text-white">{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                                    <span class="mt-2">
                                        <span class="fw-700 text-white">{{ $shortcode->primary_action_label }}</span>
                                    </span>
                                </span>
                            </a>
                        @endif
                        @if($shortcode->description)
                            <p class="mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
