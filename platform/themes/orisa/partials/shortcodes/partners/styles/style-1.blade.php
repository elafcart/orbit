<div {!! $shortcode->htmlAttributes() !!} class="at-brand-area at_fade_anim">
    @if(!empty($partners))
        <div class="carouselTicker carouselTicker-right position-relative z-1">
            <ul class="carouselTicker__list scroll-move-right">
                @foreach($partners as $partner)
                    <li class="carouselTicker__item">
                        <div class="brand-item dark-mode-invert">
                            @if(!empty($partner['url']))
                                <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
                                    {{ RvMedia::image($partner['image'], $partner['name'] ?? '') }}
                                </a>
                            @else
                                {{ RvMedia::image($partner['image'], $partner['name'] ?? '') }}
                            @endif
                        </div>
                    </li>
                @endforeach
                {{-- Duplicate items for seamless infinite scroll --}}
                @foreach($partners as $partner)
                    <li class="carouselTicker__item">
                        <div class="brand-item dark-mode-invert">
                            @if(!empty($partner['url']))
                                <a href="{{ $partner['url'] }}" target="_blank" rel="noopener noreferrer">
                                    {{ RvMedia::image($partner['image'], $partner['name'] ?? '') }}
                                </a>
                            @else
                                {{ RvMedia::image($partner['image'], $partner['name'] ?? '') }}
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
