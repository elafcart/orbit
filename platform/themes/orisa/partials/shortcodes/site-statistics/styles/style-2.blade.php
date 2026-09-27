{{-- Site Statistics Style 2: from about-1.html `home-2-section-9` ~line 575 --}}
{{-- Centered counter grid with odometer, supports title_N/data_N/unit_N attributes and tabs --}}
@php
    $bg = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    // Support legacy title_N/data_N/unit_N fields in addition to tabs
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
<section {!! $shortcode->htmlAttributes() !!} class="home-2-section-9 at-item-anime-area pt-100 pb-100 p-relative overflow-hidden"
    @if ($bg) style="background-image: url('{{ $bg }}'); background-size: cover; background-position: center;" @endif>
    <div class="container p-relative z-1">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="row mb-60">
                <div class="col-lg-8 mx-auto text-center">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                        </span>
                    @endif
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
            </div>
        @endif

        <div class="row justify-content-center g-4 at-item-anime-area">
            @foreach ($items as $item)
                @if (! empty($item['value']))
                    <div class="col-lg-3 col-md-6 col-6 text-center">
                        <h2 class="h1 fz-ds-1 fw-500 mb-0 text-nowrap">
                            <span class="odometer" data-count="{{ (int) $item['value'] }}"></span>{{ $item['suffix'] ?? '' }}
                        </h2>
                        @if (! empty($item['label']))
                            <h3 class="h6 fw-500">{!! BaseHelper::clean($item['label']) !!}</h3>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
