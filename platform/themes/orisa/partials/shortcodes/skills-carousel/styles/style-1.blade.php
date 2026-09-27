@php
    // Dark mode flips the background to neutral-900 and the text/svg to white.
    $isDark = filter_var($shortcode->dark ?? false, FILTER_VALIDATE_BOOLEAN);
    $scrollDir = $shortcode->scroll_direction ?: 'left';
    $svgFill = $isDark ? '#FEFEFE' : '#B7B7B7';
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="at-brand-area {{ $isDark ? 'bg-neutral-900 changeless py-5' : '' }}">
    @if(!empty($skills))
        <div class="carouselTicker carouselTicker-{{ $scrollDir }}">
            <ul class="d-flex align-items-center justify-content-center gap-4 carouselTicker__list scroll-move-{{ $scrollDir === 'right' ? 'left' : 'right' }}">
                @foreach($skills as $skill)
                    <li class="d-flex align-items-center gap-4 carouselTicker__item mx-0">
                        <h3 class="h5 mb-0 text-nowrap {{ $isDark ? 'neutral-0 text-white' : '' }}">{{ $skill['name'] }}</h3>
                        <svg class="scroll-rotate" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="{{ $svgFill }}" />
                        </svg>
                    </li>
                @endforeach
                {{-- Duplicate for seamless infinite scroll --}}
                @foreach($skills as $skill)
                    <li class="d-flex align-items-center gap-4 carouselTicker__item mx-0">
                        <h3 class="h5 mb-0 text-nowrap {{ $isDark ? 'neutral-0 text-white' : '' }}">{{ $skill['name'] }}</h3>
                        <svg class="scroll-rotate" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="{{ $svgFill }}" />
                        </svg>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
