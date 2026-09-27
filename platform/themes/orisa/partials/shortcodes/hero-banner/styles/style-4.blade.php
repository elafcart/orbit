{{-- Hero Banner Style 4 — gradient dark bg with cards, tech tags, brand footer --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $arrowUpSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none"><path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-hero-banner shortcode-hero-banner-style-4 container-2200 sec-1-home-4-wrap p-relative z-0 pt-85">

    <div class="sec-1-home-4 bg-linear-opacity p-relative bg-cover mt-20 rounded-5 mx-lg-3 mx-2"
        @if($shortcode->background_image) data-background="{{ RvMedia::getImageUrl($shortcode->background_image) }}" @endif>

        <div class="container p-relative z-index-1">
            <div class="row align-items-start">

                {{-- Tagline full width (wrapped in brackets per index-4.html design) --}}
                @if($shortcode->subtitle)
                    <div class="col-12">
                        <span class="sec-1-home-4__tagline d-inline-block mb-30">[ {!! BaseHelper::clean($shortcode->subtitle) !!} ]</span>
                    </div>
                @endif

                {{-- Left: headline + CTAs --}}
                <div class="col-xxl-4 col-lg-5 mb-5 mb-lg-0">
                    @if($shortcode->title)
                        <{{ $titleTag }} class="sec-1-home-4__headline text-white mb-4 mb-md-5 lh-1 {{ $titleSizeClass }}">
                            {!! BaseHelper::clean($shortcode->title) !!}
                        </{{ $titleTag }}>
                    @endif
                    <div class="sec-1-home-4__btns d-flex flex-wrap gap-3">
                        @if($shortcode->primary_action_label)
                            <a class="at-btn text-white rounded-0" href="{{ $shortcode->primary_action_url }}">
                                <span>
                                    <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </a>
                        @endif
                        @if($shortcode->secondary_action_label)
                            <a class="at-btn text-white rounded-0" href="{{ $shortcode->secondary_action_url }}">
                                <span>
                                    <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Right: image cards + tech tags --}}
                <div class="col-xxl-4 col-lg-6 col-md-10 ms-lg-auto mt-lg-0 mt-4">
                    @php
                        $cardImages = array_filter([
                            $shortcode->card_image_1 ?? null,
                            $shortcode->card_image_2 ?? null,
                            $shortcode->card_image_3 ?? null,
                        ]);
                    @endphp
                    @if(count($cardImages) > 0)
                        <div class="sec-1-home-4__cards d-flex gap-3 mb-4">
                            @foreach($cardImages as $cardImg)
                                <div class="sec-1-home-4__card rounded-3 overflow-hidden">
                                    {{ RvMedia::image($cardImg, __('Card'), attributes: ['class' => 'img-cover']) }}
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Tech / service tags --}}
                    @if(count($services) > 0)
                        <div class="sec-1-home-4__tags d-flex flex-wrap gap-3 mt-40">
                            @foreach($services as $service)
                                <a href="#" class="sec-1-home-4__tag">
                                    {{ $service['name'] }}
                                    {!! $arrowUpSvg !!}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            {{-- Footer: brand name + bottom service nav buttons --}}
            @php
                // Provided by the shortcode register via Shortcode tabs (tab_key = 'bottom_service').
                // Each item is ['name' => '...'].
                $bottomServices = collect($bottomServices ?? [])
                    ->pluck('name')
                    ->filter()
                    ->values();
            @endphp
            @if($shortcode->description || $bottomServices->isNotEmpty())
                <div class="sec-1-home-4__footer pt-60 pt-lg-8 mt-5 mt-lg-8">
                    @if($shortcode->description)
                        <h2 class="sec-1-home-4__brand text-white mb-4">
                            {!! BaseHelper::clean($shortcode->description) !!}
                        </h2>
                    @endif

                    @if($bottomServices->isNotEmpty())
                        <div class="container p-relative z-index-2">
                            <div class="row">
                                @foreach($bottomServices as $name)
                                    <div class="col-lg-3 col-md-6 col-12 text-center">
                                        <div class="at-btn at-btn-border-white ps-2 pt-20 pb-20 pe-2 text-white bg-transparent rounded-0 border-bottom-0 border-start-0 border-end-0 w-100">
                                            <span>
                                                <span class="text-1">{{ $name }}</span>
                                                <span class="text-2">{{ $name }}</span>
                                            </span>
                                            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
