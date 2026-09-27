{{-- Services Style 4: matches `sec-2-home-4` in index-4.html --}}
{{-- Heading row with avatar list + tagline, then 4-column grid of layered service cards (card-1 bg, card-2 top, card-3 dual, card-2 top) --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';

    // Decorative SVG icons per card variant (indexes 0–3 map to HTML's hardcoded sparkle/arrow/corners/flow icons).
    $defaultIconSvgs = [
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M7.5 15C11.6421 15 15 11.6421 15 7.5C15 11.6412 18.3563 14.9984 22.4971 15C18.3563 15.0016 15 18.3588 15 22.5C15 18.3579 11.6421 15 7.5 15C3.35786 15 5.08894e-07 18.3579 3.27835e-07 22.5L0 30L7.5 30C11.6421 30 15 26.6421 15 22.5C15 26.6421 18.3579 30 22.5 30L30 30L30 22.5C30 18.3588 26.6437 15.0016 22.5029 15C26.6437 14.9984 30 11.6412 30 7.5L30 6.31805e-06L22.5 6.64589e-06C18.3579 6.82695e-06 15 3.35787 15 7.5C15 3.35787 11.6421 5.21315e-06 7.5 5.39421e-06L2.62268e-06 3.8147e-06L1.63918e-06 7.5C1.096e-06 11.6421 3.35786 15 7.5 15Z" fill="currentColor"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M15 0H30V15L15 0Z" fill="currentColor"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 15V0H7.5L0 7.5V15V30H15H22.5L30 22.5V15H15ZM15 15V30L0 15H15Z" fill="currentColor"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M30 0L20 10L10 0L0 10V30L10 20L20 30L30 20V0ZM10 20V10H20V20H10Z" fill="currentColor"/></svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"><path d="M10 10L20 0H30V10L20 20V10H10Z" fill="currentColor"/><path d="M20 20H30V30H20V20Z" fill="currentColor"/><path d="M10 10L0 20V30H10L20 20H10V10Z" fill="currentColor"/><path d="M10 10H0V0H10V10Z" fill="currentColor"/></svg>',
    ];

    // Avatar strip: pull from shortcode attributes avatar_1..5 (optional).
    $avatars = collect(range(1, 5))
        ->map(fn ($i) => $shortcode->{"avatar_$i"})
        ->filter()
        ->all();
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
    // The non-semantic "div" option needs the h2 utility class to keep the original visual size.
    $titleClass = 'reveal-text lh-1' . ($titleTag === 'div' ? ' h2' : '');
@endphp
<div {!! $shortcode->htmlAttributes() !!} class="sec-2-home-4 portfolio-area pt-120 pb-120 fix">
    <div class="container">
        <div class="row pb-60">
            <div class="col-lg-2 col-md-3">
                @if($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                    </span>
                @endif
                @if($shortcode->image_1)
                    <div class="pt-40 ps-5 d-none d-md-block">
                        {{ RvMedia::image($shortcode->image_1, 'orisa', attributes: ['class' => 'portfolio-text']) }}
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-9">
                @if($shortcode->title)
                    <{{ $titleTag }} class="{{ $titleClass }} {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if($shortcode->description || ! empty($avatars))
                <div class="col-lg-3 col-md-6 ms-auto mt-md-0 mt-4">
                    @if(! empty($avatars))
                        <ul class="list-unstyled navigation-section-10">
                            @foreach($avatars as $avatar)
                                <li>
                                    <div class="icon-shape size-60 rounded-2 fix">
                                        {{ RvMedia::image($avatar, 'client', attributes: ['class' => 'img-cover']) }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if($shortcode->description)
                        <div class="d-flex gap-3 pt-30">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M27 13.5V0H13.5H0V13.5V27H13.5L27 13.5ZM27 13.5H13.5V27L0 13.5L13.5 0L27 13.5Z" fill="currentColor" /></svg>
                            </div>
                            <span class="neutral-900">{!! BaseHelper::clean($shortcode->description) !!}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Service cards: cycle through card-1 (bg image), card-2 (image bottom), card-3 (dual images) --}}
        <div class="row g-3">
            @foreach($services as $index => $service)
                @php
                    $cardVariants = ['card-1', 'card-2', 'card-3', 'card-2'];
                    $variant = $cardVariants[$index % count($cardVariants)];
                    $image = $service->image ?: $service->getMetaData('image', true);
                    $bottomImage = $service->getMetaData('bottom_image', true);
                    $iconImage = $service->getMetaData('icon_image', true);
                    $icon = $service->getMetaData('icon', true);
                    $defaultIconSvg = $defaultIconSvgs[$index % count($defaultIconSvgs)] ?? null;
                @endphp
                <div class="col-lg-3 col-md-6">
                    @if($variant === 'card-1')
                        {{-- Full bg image with dark overlay, content at bottom --}}
                        <div class="at-service-card card-1 rounded-4 overflow-hidden p-relative bg-cover" @if($image) data-background="{{ RvMedia::getImageUrl($image) }}" @endif>
                            <a href="{{ $service->url }}" class="p-absolute top-0 left-0 w-100 h-100"></a>
                            <div class="at-service-card-content text-white p-absolute bottom-0 start-0 end-0 m-xxl-5 m-4">
                                <div class="at-service-card-icon">
                                    @if($iconImage)
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $service->name }}" width="30" height="30">
                                    @elseif($icon)
                                        <x-core::icon :name="$icon" style="width:30px;height:30px" />
                                    @else
                                        {!! $defaultIconSvg !!}
                                    @endif
                                </div>
                                <h4 class="h6 text-white mt-3"><a href="{{ $service->url }}">{{ $service->name }}</a></h4>
                                @if($service->description)
                                    <div class="at-service-card-description">
                                        <p class="text-white mb-0">{!! BaseHelper::clean($service->description) !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif($variant === 'card-2')
                        {{-- Light bg, content at top, image at bottom --}}
                        <div class="at-service-card card-2 rounded-4 overflow-hidden p-relative bg-neutral-0">
                            @if($image)
                                <a href="{{ $service->url }}" class="p-absolute bottom-0 start-0 end-0">
                                    <img class="img-cover" src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                </a>
                            @endif
                            <div class="at-service-card-content p-absolute top-0 left-0 m-xxl-5 m-4">
                                <div class="at-service-card-icon">
                                    @if($iconImage)
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $service->name }}" width="30" height="30">
                                    @elseif($icon)
                                        <x-core::icon :name="$icon" style="width:30px;height:30px" />
                                    @else
                                        {!! $defaultIconSvg !!}
                                    @endif
                                </div>
                                <h4 class="h6 mt-3"><a href="{{ $service->url }}">{{ $service->name }}</a></h4>
                                @if($service->description)
                                    <div class="at-service-card-description">
                                        <p class="mb-0">{!! BaseHelper::clean($service->description) !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        {{-- card-3: dual images (top + bottom), centered content --}}
                        <div class="at-service-card card-3 rounded-4 overflow-hidden p-relative">
                            @if($image)
                                <a href="{{ $service->url }}" class="p-absolute top-0 left-0">
                                    <img class="img-cover" src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                </a>
                            @endif
                            @if($bottomImage || $image)
                                <a href="{{ $service->url }}" class="p-absolute bottom-0 start-0 end-0">
                                    <img class="img-cover" src="{{ RvMedia::getImageUrl($bottomImage ?: $image) }}" alt="{{ $service->name }}">
                                </a>
                            @endif
                            <div class="at-service-card-content text-white p-absolute top-50 left-0 mx-xxl-5 mx-4 translate-middle-y">
                                <div class="at-service-card-icon">
                                    @if($iconImage)
                                        <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="{{ $service->name }}" width="30" height="30">
                                    @elseif($icon)
                                        <x-core::icon :name="$icon" style="width:30px;height:30px" />
                                    @else
                                        {!! $defaultIconSvg !!}
                                    @endif
                                </div>
                                <h4 class="h6 text-white mt-3"><a href="{{ $service->url }}">{{ $service->name }}</a></h4>
                                @if($service->description)
                                    <div class="at-service-card-description">
                                        <p class="mb-0 text-white">{!! BaseHelper::clean($service->description) !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
