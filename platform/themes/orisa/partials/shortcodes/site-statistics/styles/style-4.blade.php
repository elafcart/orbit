{{-- Site Statistics Style 4 — about-2.html `sec-5-about` (cart-stats layout) --}}
{{-- Subtitle tag + reveal-text title (col-lg-3) on the left, --}}
{{-- cart-stats__item list with odometer + small heading + description (col-lg-7 ms-lg-auto pt-160) on the right. --}}
@php
    $subtitleTagSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';

    // Support legacy title_N / data_N / unit_N / prefix_N / description_N fields + tabs
    $items = [];
    $quantity = (int) ($shortcode->quantity ?? 0);
    if ($quantity > 0) {
        for ($i = 1; $i <= $quantity; $i++) {
            $label = $shortcode->{"title_$i"} ?? null;
            $value = $shortcode->{"data_$i"} ?? null;
            if (! $label && ! $value) {
                continue;
            }
            $items[] = [
                'label' => $label,
                'value' => $value,
                'prefix' => $shortcode->{"prefix_$i"} ?? '',
                'suffix' => $shortcode->{"unit_$i"} ?? '',
                'description' => $shortcode->{"description_$i"} ?? '',
            ];
        }
    }
    if (empty($items)) {
        $items = $tabs ?? [];
    }
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="sec-5-about bg-neutral-50 pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>
                            {!! $subtitleTagSvg !!}
                            {!! $subtitleTagSvg !!}
                        </i>
                    </span>
                @endif

                @if ($shortcode->title)
                    <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>

            @if (! empty($items))
                <div class="col-lg-7 ms-lg-auto pt-160">
                    <div class="cart-stats">
                        @foreach ($items as $index => $item)
                            @if (! empty($item['value']))
                                <div class="cart-stats__item scroll-move-up at_fade_anim" data-fade-from="bottom" data-duration="2" data-delay=".{{ $index + 1 }}">
                                    <div class="cart-stats__item-title">
                                        <h3 class="fz-ds-1 fw-500 cart-stats__item-number text-nowrap mb-0">
                                            @if (! empty($item['prefix']))
                                                <span>{{ $item['prefix'] }}</span>
                                            @endif
                                            <span class="odometer" data-count="{{ (int) $item['value'] }}"></span>{{ $item['suffix'] ?? '' }}
                                        </h3>
                                        @if (! empty($item['label']))
                                            <h4 class="h6 fw-500 mb-0">{!! BaseHelper::clean($item['label']) !!}</h4>
                                        @endif
                                    </div>

                                    @if (! empty($item['description']))
                                        <div class="cart-stats__item-content">
                                            <p class="mb-0 fz-font-lg fw-500 neutral-900">{!! BaseHelper::clean($item['description']) !!}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
