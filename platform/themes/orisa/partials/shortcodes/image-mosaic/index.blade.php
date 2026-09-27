{{-- Image Mosaic — 3-column parallax decorative grid (matches sec-5-about mg-gallery-area in about-3.html) --}}
@php
    $images = collect($items ?? [])
        ->pluck('image')
        ->filter()
        ->values();

    // Distribute images round-robin into 3 columns.
    $columns = [[], [], []];
    foreach ($images as $i => $src) {
        $columns[$i % 3][] = $src;
    }

    $speeds = [
        $shortcode->column_speed_1 ?: '-0.1',
        $shortcode->column_speed_2 ?: '0.8',
        $shortcode->column_speed_3 ?: '-0.1',
    ];
@endphp

@if ($images->isNotEmpty())
    <div {!! $shortcode->htmlAttributes() !!} class="shortcode-image-mosaic sec-5-about pt-65 pb-65">
        <div class="mg-gallery-area fix">
            <div class="container-fluid container-2200">
                <div class="at-gallery-wrapper">
                    <div class="row gx-30">
                        @foreach ($columns as $index => $column)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="at-gallery-item-wrapper" data-speed="{{ $speeds[$index] }}">
                                    @foreach ($column as $src)
                                        <div class="at-gallery-item mb-30">
                                            {{ RvMedia::image($src, 'Orisa', attributes: ['class' => 'w-100']) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
