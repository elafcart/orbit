{{-- Testimonials Style 6: from index-2.html `home-2-section-10` --}}
{{-- Pinned column (subtitle, title, CTA) on left + scrollable testimonial cards on right --}}
@php
    $arrowDiagSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $arrowRightSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="container-2200">
    <div class="rounded-5 mx-lg-3 mx-2 bg-neutral-50 overflow-hidden pb-lg-5">
        <div class="section-fix pt-120 pb-100">
            <div class="container">
                <div class="row g-5">
                    {{-- Left pinned column: subtitle, title, CTA --}}
                    <div class="col-lg-5 h-100">
                        <div class="section-title-pin h-100">
                            @if($shortcode->subtitle)
                                <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                                    <span class="text-uppercase">
                                        <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                        <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                    </span>
                                    <i>{!! $arrowDiagSvg !!}{!! $arrowDiagSvg !!}</i>
                                </span>
                            @endif

                            @if($shortcode->title)
                                <{{ $titleTag }} class="h1 section-title fw-500 fz-ds-1 lh-1 mb-30 reveal-text {{ $titleSizeClass }}">
                                    {!! BaseHelper::clean($shortcode->title) !!}
                                </{{ $titleTag }}>
                            @endif

                            @if($shortcode->action_label)
                                <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                    <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>
                                        {!! $arrowRightSvg !!}
                                    </a>
                                    <a class="at-btn z-index-1" href="{{ $shortcode->action_url ?: '#' }}">{{ $shortcode->action_label }}</a>
                                    <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>
                                        {!! $arrowRightSvg !!}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Right scrollable testimonial cards --}}
                    @if(!empty($tabs))
                        <div class="col-xxl-6 col-lg-7 ms-auto position-relative">
                            <div class="scroll-section vertical-section section scroll-active-item">
                                <div class="wrapper">
                                    <div role="list" class="list">
                                        @foreach($tabs as $item)
                                            @php
                                                $rating = (int) ($item['rating'] ?? 5);
                                                $rating = max(1, min(5, $rating));
                                            @endphp
                                            <div class="item">
                                                <div class="testimonial-cart-wrap style-2 p-md-5 p-4">
                                                    <div class="rectangular"></div>
                                                    <div class="testimonial-content-rating mb-3">
                                                        <div class="testimonial-content-rating-stars">
                                                            @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.star-rating'), ['rating' => $rating])
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-bottom-wrap">
                                                        <div class="testimonial-content">
                                                            @if(!empty($item['quote']))
                                                                <p class="testimonial-content-text fz-font-3xl fw-400 lh-sm text-truncate-4 neutral-900">
                                                                    "{!! BaseHelper::clean($item['quote']) !!}"
                                                                </p>
                                                            @endif

                                                            <div class="testimonial-author d-flex mb-0">
                                                                @if(!empty($item['avatar']))
                                                                    <div class="testimonial-left-img">
                                                                        <img src="{{ RvMedia::getImageUrl($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}">
                                                                    </div>
                                                                @endif
                                                                <div class="testimonial-content">
                                                                    @if(!empty($item['name']))
                                                                        <h3 class="h6 testimonial-content-author-name fw-600 mb-0">{{ $item['name'] }}</h3>
                                                                    @endif
                                                                    @if(!empty($item['role']))
                                                                        <p class="testimonial-content-author-position m-0">{{ $item['role'] }}</p>
                                                                    @endif
                                                                    @if(!empty($item['company']))
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
