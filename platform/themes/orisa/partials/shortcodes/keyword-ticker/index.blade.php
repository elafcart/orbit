{{-- Keyword Ticker: from services-2.html `sec-2-services` --}}
{{-- Marquee carousel of skill keywords separated by diamond SVGs --}}
@php
    $scrollDir = $shortcode->scroll_direction ?: 'left';
    $items = $items ?? [];
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-2-services pt-30 pb-30">
    @if (!empty($items))
        <div class="carouselTicker carouselTicker-{{ $scrollDir }}">
            <ul class="d-flex align-items-center justify-content-center gap-4 carouselTicker__list scroll-move-{{ $scrollDir === 'right' ? 'left' : 'right' }}">
                @foreach ($items as $item)
                    @php $name = trim((string) ($item['name'] ?? '')); @endphp
                    @if ($name !== '')
                        <li class="d-flex align-items-center gap-4 carouselTicker__item mx-0">
                            <h3 class="h5 mb-0 fz-font-md fw-600 text-nowrap">{{ $name }}</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 0C8.1206 4.36736 11.6326 7.8794 16 8C11.6326 8.1206 8.1206 11.6326 8 16C7.8794 11.6326 4.36736 8.1206 0 8C4.36736 7.8794 7.8794 4.36736 8 0Z" fill="#B7B7B7"/>
                            </svg>
                        </li>
                    @endif
                @endforeach
                {{-- Duplicate for seamless infinite scroll --}}
                @foreach ($items as $item)
                    @php $name = trim((string) ($item['name'] ?? '')); @endphp
                    @if ($name !== '')
                        <li class="d-flex align-items-center gap-4 carouselTicker__item mx-0">
                            <h3 class="h5 mb-0 fz-font-md fw-600 text-nowrap">{{ $name }}</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M8 0C8.1206 4.36736 11.6326 7.8794 16 8C11.6326 8.1206 8.1206 11.6326 8 16C7.8794 11.6326 4.36736 8.1206 0 8C4.36736 7.8794 7.8794 4.36736 8 0Z" fill="#B7B7B7"/>
                            </svg>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>
