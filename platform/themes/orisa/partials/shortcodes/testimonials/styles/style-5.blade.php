{{-- Testimonials Style 5: from index-2.html `sec-5-home-2` --}}
{{-- Avatar carousel (top) + quote slider (middle) + "Get in touch" CTA (bottom) --}}
<section {!! $shortcode->htmlAttributes() !!} class="sec-5-home-2 pt-120 pb-120">
    <div class="container">
        @if(!empty($tabs))
            {{-- Avatar thumbnails row --}}
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="swiper slider-testimonial-thumbs overflow-visible">
                        <div class="swiper-wrapper position-relative">
                            @foreach($tabs as $index => $item)
                                <div class="swiper-slide thumb-slide-{{ $index + 1 }} d-flex justify-content-center">
                                    <div class="avatar-thumbnail">
                                        @if(!empty($item['avatar']))
                                            <img class="img-cover" src="{{ RvMedia::getImageUrl($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quote slider --}}
            <div class="row">
                <div class="col-xxl-8 mx-auto">
                    <div class="swiper slider-testimonial-2 mt-50">
                        <div class="swiper-wrapper">
                            @foreach($tabs as $item)
                                <div class="swiper-slide">
                                    <div class="text-center">
                                        @if(!empty($item['quote']))
                                            <h2 class="h3 fw-700 reveal-text">
                                                {!! BaseHelper::clean($item['quote']) !!}
                                            </h2>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($shortcode->action_label)
                        <div class="justify-content-center d-flex mt-50">
                            <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/>
                                    </svg>
                                </a>
                                <a class="at-btn z-index-1" href="{{ $shortcode->action_url ?: '#' }}">{{ $shortcode->action_label }}</a>
                                <a class="at-btn-circle" href="{{ $shortcode->action_url ?: '#' }}" aria-label="{{ $shortcode->action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->action_label ?: __('Learn more') }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                                        <path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>
