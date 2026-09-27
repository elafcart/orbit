{{-- Site Statistics Style 3 — About-3 "Years of Practice" wide flex row (matches sec-4-about in about-3.html) --}}
@php
    // Support legacy title_N / data_N / unit_N / prefix_N fields + tabs
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
            ];
        }
    }
    if (empty($items)) {
        $items = $tabs ?? [];
    }
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="sec-4-about pt-120 pb-120">
    <div class="container">
        <div class="row">
            @if ($shortcode->title)
                <div class="col-lg-8">
                    <{{ $titleTag }} class="reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                </div>
            @endif

            @if (! empty($items))
                <div class="pt-100">
                    <div class="d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center gap-md-5 gap-4">
                        @foreach ($items as $item)
                            @if (! empty($item['value']))
                                <div class="text-center">
                                    <h4 class="h1 fw-600 mb-0">
                                        @if (! empty($item['prefix']))
                                            {{ $item['prefix'] }}
                                        @endif
                                        <span class="odometer" data-count="{{ (int) $item['value'] }}"></span>{{ $item['suffix'] ?? '' }}
                                    </h4>
                                    @if (! empty($item['label']))
                                        <p class="h6 fw-500 fz-font-md neutral-500 mb-0">{!! BaseHelper::clean($item['label']) !!}</p>
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
