{{-- Image Gallery Style 1: from index-2.html `home-2-section-8` --}}
{{-- Full-width swiper of rounded images --}}
<div {!! $shortcode->htmlAttributes() !!} class="home-2-section-8">
    @if (!empty($images))
        <div class="swiper about-me-slider-active at-item-anime-area">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    @if (!empty($image['image']))
                        <div class="swiper-slide">
                            <div class="about-me-slider-thumb at-item-anime marque">
                                <img class="w-100 rounded-4" src="{{ RvMedia::getImageUrl($image['image']) }}" alt="{{ $image['alt'] ?? '' }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>
