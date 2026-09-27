@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!}>
    <div class="container-2200">
        <div class="sec-6-home-1 mx-lg-3 mx-2 bg-black pt-100 pb-100 rounded-5 changeless overflow-hidden">
            <div class="container">
                <div class="row align-items-end mb-50 g-3 z-index-2">
                    <div class="col-md-8">
                        {{-- Brand icon --}}
                        <svg class="fill-primary mb-20" xmlns="http://www.w3.org/2000/svg" width="40" height="42" viewBox="0 0 40 42" fill="none">
                            <path d="M16 14L12 7L16 0H24L28 7H20L16 14Z" fill="currentColor" />
                            <path d="M36 21L32 14H24L28 7H36L40 14L36 21Z" fill="currentColor" />
                            <path d="M28 35H36L40 28L36 21H28L32 28L28 35Z" fill="currentColor" />
                            <path d="M12 35H20L24 28L28 35L24 42H16L12 35Z" fill="currentColor" />
                            <path d="M4 21H12L8 14L12 7H4L0 14L4 21Z" fill="currentColor" />
                            <path d="M4 21L0 28L4 35H12L16 28H8L4 21Z" fill="currentColor" />
                        </svg>

                        @if ($shortcode->title)
                            <{{ $titleTag }} class="alt-section-title lh-1 mb-10 reveal-text text-white {{ $titleSizeClass }}">
                                {!! BaseHelper::clean($shortcode->title) !!}
                            </{{ $titleTag }}>
                        @endif

                        @if ($shortcode->subtitle)
                            <p class="mg-portfolio-dec mb-0 text-white">
                                {!! BaseHelper::clean($shortcode->subtitle) !!}
                            </p>
                        @endif
                    </div>

                    @if (count($tabs) > 1)
                        <div class="col-lg-2 ms-auto">
                            <div class="swiper-button-wrapper justify-content-end">
                                <button class="swiper-btn-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                        <path d="M11.3481 7.47314L5.25879 13.2856L11.3481 19.0981" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M21.3124 13.2856H5.53564" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button class="swiper-btn-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                        <path d="M15.2234 7.47314L21.3126 13.2856L15.2234 19.0981" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.259 13.2856H21.0358" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-12 scroll-move-up2 z-index-2">
                        <div class="swiper slider-testimonial">
                            <div class="swiper-wrapper">
                                @foreach ($tabs as $item)
                                    @php
                                        $rating = (int) ($item['rating'] ?? 5);
                                        $rating = max(1, min(5, $rating));
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="testimonial-cart-wrap p-xxl-5 p-lg-4 p-md-5 p-3">
                                            <div class="rectangular"></div>
                                            <div class="testimonial-top d-flex align-items-center justify-content-between">
                                                <div class="testimonial-top-left-img">
                                                    @if (!empty($item['avatar']))
                                                        <img src="{{ RvMedia::getImageUrl($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}">
                                                    @endif
                                                </div>
                                                <div class="testimonial-top-right-logo">
                                                    @if (!empty($item['company_logo']))
                                                        <img src="{{ RvMedia::getImageUrl($item['company_logo']) }}" alt="{{ $item['company'] ?? '' }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="testimonial-bottom-wrap">
                                                <div class="testimonial-content">
                                                    @if (!empty($item['quote']))
                                                        <p class="testimonial-content-text neutral-0 fz-font-3xl fw-400 text-truncate-4">
                                                            "{!! BaseHelper::clean($item['quote']) !!}"
                                                        </p>
                                                    @endif
                                                    <div class="testimonial-content-rating mt-3">
                                                        <div class="testimonial-content-rating-stars">
                                                            {{-- Inline star SVG — 5 stars, filled gold up to $rating, grey after --}}
                                                            @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.star-rating'), ['rating' => $rating])
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-content-author">
                                                        @if (!empty($item['name']))
                                                            <h3 class="h6 testimonial-content-author-name common-white fw-600">
                                                                {{ $item['name'] }}
                                                            </h3>
                                                        @endif
                                                        @if (!empty($item['role']))
                                                            <p class="testimonial-content-author-position m-0">{{ $item['role'] }}</p>
                                                        @endif
                                                        @if (!empty($item['company']))
                                                            <p class="testimonial-content-author-company m-0">{{ $item['company'] }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center pt-50 z-index-1">
                        <a href="{{ $shortcode->action_url ?: 'mailto:hello@orisa.com' }}" class="at-btn bg-transparent p-relative">
                            <img class="badge-zoon-in" src="{{ Theme::asset()->url('images/icons/badge-2.svg') }}" alt="{{ Theme::getSiteName() }}">
                            <span class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center overflow-unset">
                                <span class="mt-2 badge-text-zoom-in overflow-unset text-wrap">
                                    <span class="fw-700 common-white text-uppercase overflow-unset">
                                        {!! BaseHelper::clean($shortcode->action_label) ?: __('Client <br>Stories') !!}
                                    </span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
