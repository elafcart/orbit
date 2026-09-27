@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!}>
    <div class="container-2200">
        <div class="at-sec8-area pt-90 pb-90 bg-neutral-50 rounded-5 mx-lg-3 mx-2"
            @if ($shortcode->background_image)
                style="background-image: url('{{ RvMedia::getImageUrl($shortcode->background_image) }}'); background-size: cover; background-position: center;"
            @endif
        >
            <div class="container">
                @if ($shortcode->title || $shortcode->subtitle)
                    <div class="row mb-50">
                        <div class="col-12 text-center">
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

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap justify-content-lg-between justify-content-around align-items-center gap-4">
                            @foreach ($tabs as $item)
                                @if (!empty($item['value']))
                                    <div class="text-center">
                                        {{-- Use <p class="h1"> rather than a real <h1> so each page only emits one semantic H1 (the page-content one). The h1 class preserves the visual size; matches the footer pattern. --}}
                                        <p class="h1 mb-0">
                                            <span
                                                class="odometer text-nowrap"
                                                data-count="{{ (int) $item['value'] }}"
                                            ></span>{{ $item['suffix'] ?? '' }}
                                        </p>
                                        @if (!empty($item['label']))
                                            <p>{!! BaseHelper::clean($item['label']) !!}</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
