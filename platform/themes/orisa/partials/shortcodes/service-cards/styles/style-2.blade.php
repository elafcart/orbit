{{-- Service Cards Style 2: from pricing.html `sec-4-services-details` --}}
{{-- "How we approach strategy" — header row + 4 numbered cards [01]..[04] --}}
@php
    $cards = $cards ?? [];
    // Card variant rotation matches reference: card-1 (no-before), card-2, card-3, card-2
    $variantMap = [0 => 'card-1 no-before', 1 => 'card-2', 2 => 'card-3', 3 => 'card-2'];
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-4-services-details pb-120 pt-120 bg-neutral-50">
    <div class="container">
        @if ($shortcode->subtitle || $shortcode->title || $shortcode->description)
            <div class="row g-4">
                <div class="col-lg-6">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                            <i>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor" />
                                </svg>
                            </i>
                        </span>
                    @endif
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="reveal-text mb-20 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                    @if ($shortcode->description)
                        <h3 class="h6 fw-500 mb-0">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                    @endif
                </div>
                <div class="col-lg-4 col-md-8 ms-auto text-end">
                    <div class="scroll-rotate d-md-inline-block d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none" aria-hidden="true">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M53.5715 0H46.4286V41.3778L17.17 12.1193L12.1193 17.17L41.3778 46.4286H0V53.5715H41.3778L12.1193 82.83L17.17 87.8805L46.4286 58.622V100H53.5715V58.622L82.83 87.8805L87.8805 82.83L58.622 53.5715H100V46.4286H58.622L87.8805 17.17L82.83 12.1193L53.5715 41.3778V0Z" fill="currentColor" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-3 pt-100">
            @foreach ($cards as $index => $card)
                @php
                    $variantClasses = $variantMap[$index % 4] ?? 'card-1 no-before';
                    $cardTitle = $card['title'] ?? '';
                    $cardDescription = $card['description'] ?? '';
                    $cardImage = $card['image'] ?? '';
                    $cardUrl = $card['url'] ?? '#';
                    $number = sprintf('[%02d]', $index + 1);
                @endphp
                <div class="col-xxl-3 col-md-6">
                    <div class="at-service-card hover-up {{ $variantClasses }} rounded-2 overflow-hidden p-relative bg-neutral-0 @if($index === 0) z-index-3 @endif">
                        <a href="{{ $cardUrl }}" class="p-absolute top-0 left-0 w-100 h-100" aria-label="{{ $cardTitle }}"></a>
                        <div class="at-service-card-content m-lg-5 m-4">
                            <div class="at-service-card-number">
                                <h3 class="h6 fw-600 neutral-300">{{ $number }}</h3>
                            </div>
                            @if ($cardTitle)
                                <h4 class="mt-3 fw-600"><a href="{{ $cardUrl }}">{{ $cardTitle }}</a></h4>
                            @endif
                            @if ($cardDescription)
                                <div class="at-service-card-description">
                                    <p class="mb-0 neutral-900">{!! BaseHelper::clean($cardDescription) !!}</p>
                                </div>
                            @endif
                            @if ($cardImage)
                                <div class="at-service-card-img rounded-2 fix mt-4 hover-effect-1">
                                    <img class="img-cover rounded-2" src="{{ RvMedia::getImageUrl($cardImage) }}" alt="{{ $cardTitle ?: Theme::getSiteName() }}">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
