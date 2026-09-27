{{-- Testimonials Style 2: from services-2.html `sec-3-about` ~line 766 --}}
{{-- Title + nav buttons on top, swiper carousel of light cards with stars + quote + author --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="sec-3-about pt-120 pb-120 border-bottom-100" @if($shortcode->background_image) style="margin-bottom: 80px" @endif>
    <div class="container">
        <div class="row align-items-end mb-50 g-3 z-index-2">
            <div class="col-lg-7 col-md-7">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                    </span>
                @endif

                @if ($shortcode->title)
                    <{{ $titleTag }} class="reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if ($shortcode->description)
                    <p class="fz-font-lg neutral-600 mb-0 mt-3">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>

            @if (count($tabs) > 1)
                <div class="col-lg-2 ms-auto">
                    <div class="swiper-button-wrapper justify-content-end">
                        <button class="swiper-btn-prev bg-neutral-50 neutral-900 border-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                <path d="M11.3481 7.47314L5.25879 13.2856L11.3481 19.0981" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21.3124 13.2856H5.53564" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button class="swiper-btn-next bg-neutral-50 neutral-900 border-0">
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
                                <div class="testimonial-cart-wrap style-2 p-xxl-5 p-4 bg-neutral-50">
                                    <div class="testimonial-content-rating mb-3">
                                        <div class="testimonial-content-rating-stars">
                                            @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.star-rating'), ['rating' => $rating])
                                        </div>
                                    </div>
                                    <div class="testimonial-bottom-wrap">
                                        <div class="testimonial-content">
                                            @if (!empty($item['quote']))
                                                <p class="testimonial-content-text fz-font-3xl fw-400 lh-sm text-truncate-4 neutral-900">
                                                    "{!! BaseHelper::clean($item['quote']) !!}"
                                                </p>
                                            @endif
                                            <div class="testimonial-author pt-100 d-flex mb-0">
                                                @if (!empty($item['avatar']))
                                                    <div class="testimonial-left-img">
                                                        <img src="{{ RvMedia::getImageUrl($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}">
                                                    </div>
                                                @endif
                                                <div class="testimonial-content">
                                                    @if (!empty($item['name']))
                                                        <h4 class="h6 testimonial-content-author-name fw-600 mb-0">{{ $item['name'] }}</h4>
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($shortcode->primary_action_label)
            <div class="row pt-50">
                <div class="col-12 text-center">
                    <div class="at-btn-group at_fade_anim d-inline-flex" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                            </svg>
                        </a>
                        <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
