{{-- Image Gallery Style 2: from about-2.html `sec-4-about` moving-gallery --}}
{{-- Horizontal infinite-scroll carousel ticker of varied-height portrait images --}}
<div {!! $shortcode->htmlAttributes() !!} class="sec-4-about pt-120">
    @if (!empty($images))
        <div
            class="moving-gallery at_fade_anim carouselTicker carouselTicker-left"
            data-delay=".5"
            data-fade-from="bottom"
            data-ease="bounce"
        >
            <ul class="wrapper-gallery carouselTicker__list scroll-move-left">
                @foreach ($images as $image)
                    @if (!empty($image['image']))
                        <li>
                            <img
                                decoding="async"
                                src="{{ RvMedia::getImageUrl($image['image']) }}"
                                alt="{{ $image['alt'] ?? Theme::getSiteName() }}"
                                loading="lazy"
                            >
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>
