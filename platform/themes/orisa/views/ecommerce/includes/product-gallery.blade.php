{{-- Gallery image layout (digital-store style): a large main image with a
     clickable thumbnail strip below. Clicking a thumbnail swaps the main image
     in place (no page reload). Rendered when Theme options -> Ecommerce ->
     "Product image layout" is set to "Gallery". Expects $images (array, max 6). --}}
@php
    $mainImage = $images[0] ?? null;
@endphp
@if($mainImage)
    <div class="product-detail-gallery" id="product-detail-gallery">
        <div class="product-detail-gallery__main">
            <a href="{{ RvMedia::getImageUrl($mainImage) }}"
               class="product-detail-gallery__main-link popup-image"
               id="product-detail-gallery-main-link">
                {{-- eager: this is the LCP element, RvMedia defaults to lazy. --}}
                {{ RvMedia::image($mainImage, $product->name, attributes: ['class' => 'product-detail-gallery__main-img', 'id' => 'product-detail-gallery-main-img', 'loading' => 'eager']) }}
            </a>
        </div>

        @if(count($images) > 1)
            <div class="product-detail-gallery__thumbs">
                @foreach($images as $index => $img)
                    {{-- Empty alt: the button already carries the aria-label, so a
                         second description would be announced twice. --}}
                    <button type="button"
                            class="product-detail-gallery__thumb {{ $index === 0 ? 'active' : '' }}"
                            data-full="{{ RvMedia::getImageUrl($img) }}"
                            aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="{{ __('View image :number', ['number' => $index + 1]) }}">
                        {{ RvMedia::image($img, '', attributes: ['class' => 'product-detail-gallery__thumb-img']) }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        (function () {
            var gallery = document.getElementById('product-detail-gallery');
            if (! gallery) {
                return;
            }

            var mainImg = document.getElementById('product-detail-gallery-main-img');
            var mainLink = document.getElementById('product-detail-gallery-main-link');
            if (! mainImg || ! mainLink) {
                return;
            }

            var fadeTimer = null;

            gallery.querySelectorAll('.product-detail-gallery__thumb').forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    var fullUrl = thumb.getAttribute('data-full');
                    if (! fullUrl) {
                        return;
                    }

                    mainImg.style.opacity = '0';
                    clearTimeout(fadeTimer);
                    fadeTimer = setTimeout(function () {
                        mainImg.src = fullUrl;
                        // Keep lazy-load in sync: when theme option "lazy load images"
                        // is on, the img is rewritten to data-src + data-bb-lazy and
                        // vanilla-lazyload would otherwise restore the first image.
                        if (mainImg.hasAttribute('data-src')) {
                            mainImg.setAttribute('data-src', fullUrl);
                        }
                        mainImg.style.opacity = '1';
                    }, 150);
                    mainLink.setAttribute('href', fullUrl);

                    gallery.querySelectorAll('.product-detail-gallery__thumb').forEach(function (el) {
                        el.classList.remove('active');
                        el.setAttribute('aria-pressed', 'false');
                    });
                    thumb.classList.add('active');
                    thumb.setAttribute('aria-pressed', 'true');
                });
            });
        })();
    </script>
@endif
