{{-- Testimonials Style 3: inspired by index-4.html `home-4-section-7` ~line 1502 --}}
{{-- 2-column dark background: left rating/title card + right large quote card --}}
@php
    $first = collect($tabs)->first() ?? [];
    $firstRating = (int) ($first['rating'] ?? 5);
    $firstRating = max(1, min(5, $firstRating));
    $bg = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120">
    <div class="container">
        <div class="row g-2">
            {{-- Left card: subtitle + title + rating --}}
            <div class="col-lg-4">
                <div class="p-relative rounded-4 overflow-hidden bg-cover bg-linear-opacity p-xxl-5 p-md-5 p-4 h-100"
                    @if ($bg) data-background="{{ $bg }}" style="background-image: url('{{ $bg }}'); background-size: cover; background-position: center;" @else style="background-color: #1D1D1D;" @endif>
                    @if ($shortcode->subtitle)
                        <span class="at-btn text-white bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                        </span>
                    @endif

                    @if ($shortcode->title)
                        <{{ $titleTag }} class="text-white reveal-text mb-60 pb-60 border-bottom-opacity {{ $titleSizeClass }}">
                            {!! BaseHelper::clean($shortcode->title) !!}
                        </{{ $titleTag }}>
                    @endif

                    <div class="d-flex align-items-center gap-4">
                        <div class="rotate-infinite">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M53.5715 0H46.4286V41.3778L17.17 12.1193L12.1193 17.17L41.3778 46.4286H0V53.5715H41.3778L12.1193 82.83L17.17 87.8805L46.4286 58.622V100H53.5715V58.622L82.83 87.8805L87.8805 82.83L58.622 53.5715H100V46.4286H58.622L87.8805 17.17L82.83 12.1193L53.5715 41.3778V0Z" fill="#FEFEFE" />
                            </svg>
                        </div>
                        <div>
                            <div class="testimonial-star d-flex align-items-center gap-2">
                                @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.star-rating'), ['rating' => $firstRating])
                            </div>
                            @if ($shortcode->description)
                                <p class="text-white fz-font-sm mb-0 mt-2">{!! BaseHelper::clean($shortcode->description) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right card: swiper of large quotes --}}
            <div class="col-lg-8">
                <div class="p-relative rounded-4 overflow-hidden bg-cover bg-linear-opacity p-xxl-5 p-lg-4 p-md-3 h-100 d-flex align-items-center justify-content-center"
                    style="background-color: #2A2A2A;">
                    <div class="swiper slider-testimonial w-100">
                        <div class="swiper-wrapper">
                            @foreach ($tabs as $item)
                                <div class="swiper-slide">
                                    <div class="d-flex flex-lg-nowrap flex-wrap gap-5 p-md-5 p-4">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="61" height="43" viewBox="0 0 61 43" fill="none">
                                                <path d="M4.3 43H17.2L25.8 25.8V0H0V25.8H12.9L4.3 43ZM38.7 43H51.6L60.2 25.8V0H34.4V25.8H47.3L38.7 43Z" fill="#FEFEFE" />
                                            </svg>
                                        </div>
                                        <div class="content">
                                            @if (!empty($item['quote']))
                                                <p class="text-white fz-font-3xl fw-400 mb-50 lh-base">
                                                    {!! BaseHelper::clean($item['quote']) !!}
                                                </p>
                                            @endif
                                            @if (!empty($item['name']))
                                                <h3 class="h5 text-white fw-500">{{ $item['name'] }}</h3>
                                            @endif
                                            @if (!empty($item['role']) || !empty($item['company']))
                                                <p class="text-white fz-font-md fw-500 opacity-75 mb-0">
                                                    {{ trim(($item['role'] ?? '') . (!empty($item['role']) && !empty($item['company']) ? ', ' : '') . ($item['company'] ?? '')) }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
