{{-- Partners Style 3: from index-3.html `sec-3-home-3` --}}
{{-- Two columns: left info (ripple image + lightning icon + title + right image) / right brand logo grid --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="sec-3-home-3 pt-130 pb-130 bg-neutral-50">
    <div class="container">
        <div class="row g-xxl-5 g-4">
            {{-- Left column: optional info block (image + title + icon + secondary image) --}}
            @if($styleImage1 || $shortcode->title || $styleImage2)
                <div class="col-3xl-6 col-xxl-5 col-lg-3 col-12">
                    <div class="row g-xxl-5 g-4">
                        @if($styleImage1)
                            <div class="col-xxl-5 col-lg-12 col-md-5 col-12 d-lg-none d-xxl-block">
                                <div class="img-left ripple-image ripples">
                                    {{ RvMedia::image($styleImage1, $shortcode->title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
                                </div>
                            </div>
                        @endif

                        <div class="col-xxl-7 col-lg-12 col-md-7 col-12">
                            <div class="d-flex flex-column gap-3">
                                @if($shortcode->title)
                                    <div class="d-flex gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="43" viewBox="0 0 34 43" fill="none">
                                            <path d="M12.5 26.66L3.00442 26.66C0.68247 26.66 -0.759179 24.4843 0.420807 22.761L14.986 1.48852C16.7967 -1.15609 21.5 -0.0494029 21.5 3.02127L21.5 16.34L30.9956 16.34C33.3175 16.34 34.7592 18.5157 33.5792 20.239L19.014 41.5115C17.2033 44.1561 12.5 43.0494 12.5 39.9787L12.5 26.66Z" fill="currentColor"/>
                                        </svg>
                                        <{{ $titleTag }} class="h4 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                                    </div>
                                @endif

                                @if($styleImage2)
                                    <div class="img-right">
                                        {{ RvMedia::image($styleImage2, $shortcode->title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Right column: brand logo grid with optional revenue stat --}}
            @if(!empty($partners))
                <div class="col-3xl-6 col-xxl-7 col-lg-9 col-12">
                    <div class="d-inline-flex">
                        <div class="at-brand-scroll">
                            <div class="at-brand-scroll-wrap d-flex flex-wrap justify-content-end gap-2">
                                @foreach($partners as $partner)
                                    <div class="at-brand-item at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                        <div class="brand">
                                            @if(!empty($partner['url']))
                                                <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
                                                    {{ RvMedia::image($partner['image'], $partner['name'] ?? '', attributes: ['class' => 'at-brand-logo dark-mode-invert']) }}
                                                </a>
                                            @else
                                                {{ RvMedia::image($partner['image'], $partner['name'] ?? '', attributes: ['class' => 'at-brand-logo dark-mode-invert']) }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Optional revenue stat in the middle --}}
                                @if($shortcode->stat_value)
                                    <div class="flex-grow-1 text-center d-flex flex-column justify-content-center align-items-center ms-lg-5">
                                        <h2 class="mb-0">{{ $shortcode->stat_prefix ?: '' }}<span class="odometer" data-count="{{ $shortcode->stat_value }}"></span>{{ $shortcode->stat_suffix ?: '' }}</h2>
                                        @if($shortcode->description)
                                            <p class="fz-font-lg text-start mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
