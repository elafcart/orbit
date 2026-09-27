{{-- Partners Style 4 — Home5 "Trusted by" carousel with 5-star customer reviews CTA (matches sec-3-home-5 in index-5.html) --}}
@php
    $starSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none"><path d="M8.55696 13.6975L12.707 16.2075C13.467 16.6675 14.397 15.9875 14.197 15.1275L13.097 10.4075L16.767 7.2275C17.437 6.6475 17.077 5.5475 16.197 5.4775L11.367 5.0675L9.47696 0.6075C9.13696 -0.2025 7.97696 -0.2025 7.63696 0.6075L5.74696 5.0575L0.916957 5.4675C0.0369575 5.5375 -0.323043 6.6375 0.346957 7.2175L4.01696 10.3975L2.91696 15.1175C2.71696 15.9775 3.64696 16.6575 4.40696 16.1975L8.55696 13.6975Z" fill="currentColor"/></svg>';
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';

    $rating = (int) ($shortcode->review_rating ?: 3);
    $reviewLabel = $shortcode->review_label ?: 'Customer reviews';
    $reviewUrl = $shortcode->review_url ?: '#';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="sec-3-home-5 pt-130 pb-110">
    <div class="container">
        <div class="row g-4">
            {{-- Left: subtitle + title --}}
            <div class="col-xxl-4 col-lg-8 col-12">
                @if ($shortcode->subtitle)
                    <h3 class="h6 fz-font-md text-uppercase neutral-500 fw-600 mb-30">{{ $shortcode->subtitle }}</h3>
                @endif
                @if ($shortcode->title)
                    <{{ $titleTag }} class="h5 fw-600 reveal-text pe-xxl-5 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>

            {{-- Right: brand carousel + reviews CTA --}}
            <div class="col-xxl-8 col-12">
                <div class="d-inline-flex">
                    <div class="at-brand-scroll">
                        <div class="at-brand-scroll-wrap d-flex flex-wrap gap-2">
                            @foreach ($partners as $index => $partner)
                                <div class="at-brand-item at_fade_anim" data-delay=".{{ 4 + ($index % 4) }}" data-fade-from="bottom" data-ease="bounce">
                                    <div class="brand">
                                        @if (! empty($partner['url']))
                                            <a href="{{ $partner['url'] }}" target="_blank" rel="noopener">
                                                {{ RvMedia::image($partner['image'], $partner['name'] ?? '', attributes: ['class' => 'at-brand-logo dark-mode-invert']) }}
                                            </a>
                                        @else
                                            {{ RvMedia::image($partner['image'], $partner['name'] ?? '', attributes: ['class' => 'at-brand-logo dark-mode-invert']) }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            {{-- Customer reviews block --}}
                            <div class="flex-grow-1 text-center d-flex flex-column justify-content-center ml-100 py-5">
                                <div class="d-flex mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $rating ? 'star' : '' }}">{!! $starSvg !!}</span>
                                    @endfor
                                </div>
                                <div class="d-flex">
                                    <a href="{{ $reviewUrl }}" class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                                        <span class="text-uppercase">
                                            <span class="text-1">{{ $reviewLabel }}</span>
                                            <span class="text-2">{{ $reviewLabel }}</span>
                                        </span>
                                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
