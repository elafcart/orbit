{{-- Testimonials Style 4: grid layout with background image (for Pricing page) --}}
{{-- Grid of light cards with rating + quote + author on cover background --}}
@php
    $bg = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : '';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120 p-relative overflow-hidden"
    @if ($bg) style="background-image: url('{{ $bg }}'); background-size: cover; background-position: center;" @endif>
    <div class="container p-relative z-1">
        @if ($shortcode->title || $shortcode->subtitle || $shortcode->description)
            <div class="row mb-50">
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
                        <{{ $titleTag }} class="reveal-text mb-3 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif

                    @if ($shortcode->description)
                        <p class="fz-font-lg neutral-600 mb-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="row g-4">
            @foreach ($tabs as $item)
                @php
                    $rating = (int) ($item['rating'] ?? 5);
                    $rating = max(1, min(5, $rating));
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-cart-wrap style-2 p-xxl-5 p-4 bg-neutral-0 rounded-4 h-100">
                        <div class="testimonial-content-rating mb-3">
                            <div class="testimonial-content-rating-stars">
                                @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.star-rating'), ['rating' => $rating])
                            </div>
                        </div>

                        @if (!empty($item['quote']))
                            <p class="testimonial-content-text fz-font-lg fw-400 lh-sm text-truncate-5 neutral-900 mb-4">
                                "{!! BaseHelper::clean($item['quote']) !!}"
                            </p>
                        @endif

                        <div class="testimonial-author d-flex align-items-center gap-3 mt-auto">
                            @if (!empty($item['avatar']))
                                <div class="testimonial-left-img rounded-circle overflow-hidden" style="width: 56px; height: 56px; flex-shrink: 0;">
                                    <img src="{{ RvMedia::getImageUrl($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}" class="img-cover w-100 h-100">
                                </div>
                            @endif
                            <div>
                                @if (!empty($item['name']))
                                    <h4 class="h6 fw-600 mb-0 neutral-900">{{ $item['name'] }}</h4>
                                @endif
                                @if (!empty($item['role']))
                                    <p class="fz-font-sm m-0 neutral-600">{{ $item['role'] }}</p>
                                @endif
                                @if (!empty($item['company']))
                                    <p class="fz-font-sm m-0 neutral-600">{{ $item['company'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
