{{-- Product detail: 2-col layout (image left, product info right) + tabs.
     The image column has two layouts, selectable in Theme options -> Ecommerce
     -> "Product image layout":
       - grid    (default): 2-column image grid, best for physical products.
       - gallery: large main image + thumbnail strip and full-width tabs below,
                  best for digital products (ticket 4576446). --}}
@php
    $galleryStyle = theme_option('product_detail_gallery_style', 'grid');
    $images = $product->images ?: [];
    if (empty($images) && $product->image) {
        $images = [$product->image];
    }
    $images = array_slice($images, 0, 6);
    $discountPercent = \Theme\Orisa\Support\ThemeHelper::saleDiscountPercent($product);
@endphp
<div class="sec-1-shop-details overflow-hidden pt-150">
    <div class="container">
        <div class="row">
            {{-- Image column: gallery (digital) or grid (default) --}}
            <div class="col-lg-6">
                @if($galleryStyle === 'gallery')
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-gallery'), ['images' => $images])
                @else
                    <div class="row g-3">
                        @foreach($images as $img)
                            <div class="col-md-6">
                                <div class="product-card">
                                    <div class="product-card__inner">
                                        <div class="product-card__thumb">
                                            <a href="{{ RvMedia::getImageUrl($img) }}" class="product-card__img-link d-flex justify-content-center align-items-end">
                                                {{ RvMedia::image($img, $product->name, attributes: ['class' => 'product-card__img']) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product info panel --}}
            <div class="col-lg-6">
                <div class="content-product-right px-lg-5 pt-30">
                    <div class="content-product-right__top d-flex flex-wrap align-items-center gap-3 mb-2">
                        @if($product->quantity > 0 || $product->allow_checkout_when_out_of_stock)
                            <span class="content-product-right__badge">{{ __('In Stock') }}</span>
                        @else
                            <span class="content-product-right__badge content-product-right__badge--out">{{ __('Out of Stock') }}</span>
                        @endif
                        @if($product->brand)
                            <span class="content-product-right__brand">{{ strtoupper($product->brand->name) }}</span>
                        @endif
                    </div>

                    <h4 class="h5 content-product-right__title">{{ $product->name }}</h4>

                    <div class="d-flex align-items-center flex-wrap gap-3 mb-1">
                        <h5 class="h6 content-product-right__price mb-0">{{ format_price($product->front_sale_price) }}</h5>
                        @if($product->front_sale_price < $product->price)
                            <span class="text-decoration-line-through opacity-50 fz-font-sm">{{ format_price($product->price) }}</span>
                            @if($discountPercent > 0)
                                <span class="content-product-right__save-badge">{{ __('Save :percent%', ['percent' => $discountPercent]) }}</span>
                            @endif
                        @endif
                    </div>
                    <p class="content-product-right__shipping fz-font-sm mb-4">{{ __('Shipping calculated at checkout.') }}</p>

                    @if($product->description)
                        <div class="content-product-right__excerpt mb-4 w-50">
                            <p class="content-product-right__excerpt-text">
                                <span class="content-product-right__excerpt-text-content">
                                    {!! BaseHelper::clean($product->description) !!}
                                </span>
                                @if($product->content)
                                    <a href="#tab-description" id="product-read-more-link" class="content-product-right__read-more" data-bs-toggle="tab">{{ __('Read more') }}</a>
                                @endif
                            </p>
                        </div>
                    @endif

                    {{-- Add-to-cart + Buy Now form.
                         data-bb-toggle="product-form" wires Botble's front-ecommerce.js: it serializes
                         the form, requires a resolved variation (input[name="id"] must be non-empty),
                         adds to cart via AJAX, and redirects to next_url when the clicked submit is
                         name="checkout". Swatches/options MUST live inside this form so the variation
                         JS can update input[name="id"] with the customer's selection. --}}
                    <form class="add-to-cart-form single-variation-wrap" data-bb-toggle="product-form" method="POST" action="{{ route('public.cart.add-to-cart') }}">
                        @csrf

                        {{-- Variation swatches (variable products only) + product add-on options.
                             These were previously rendered via a non-existent filter and sat outside
                             the form, so the selected variation was never submitted. --}}
                        @if($product->has_variation)
                            <div class="product-filters row mb-3">
                                {!! render_product_swatches($product) !!}
                            </div>
                        @endif

                        {!! render_product_options($product) !!}

                        <input type="hidden" name="product_is_out_of_stock" value="{{ $product->isOutOfStock() }}">
                        <input type="hidden" name="id" value="{{ $product->id }}">

                        @if (EcommerceHelper::isCartEnabled())
                        <div class="content-product-right__option content-product-right__option--qty mb-4">
                            <label class="content-product-right__option-label">{{ __('Quantity') }}</label>
                            <div class="content-product-right__actions d-flex flex-wrap align-items-center gap-3">
                                <div class="content-product-right__qty">
                                    <button type="button" class="content-product-right__qty-btn qty-down" aria-label="{{ __('Decrease') }}">−</button>
                                    <input type="number" name="qty" value="1" min="1" class="content-product-right__qty-val qty-val border-0 bg-transparent text-center" style="width:40px">
                                    <button type="button" class="content-product-right__qty-btn qty-up" aria-label="{{ __('Increase') }}">+</button>
                                </div>
                                <button type="submit" name="add-to-cart" class="at-btn content-product-right__btn content-product-right__btn--outline" @disabled($product->isOutOfStock())>
                                    <span class="text-nowrap">
                                        <span class="text-1">{{ __('ADD TO CART') }}</span>
                                        <span class="text-2">{{ __('ADD TO CART') }}</span>
                                    </span>
                                    <i class="icon-arrow-up-right">
                                        <svg width="14" height="14" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 0 9.9375 0L3.1875 0C2.77329 0 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/>
                                        </svg>
                                    </i>
                                </button>
                            </div>
                        </div>

                        <div class="w-75 mb-40">
                            {{-- Buy It Now: same form, name="checkout" → controller returns the checkout
                                 URL as next_url and front-ecommerce.js redirects there. The cart-vs-checkout
                                 destination stays configurable via Botble's Quick Buy button setting. --}}
                            <button type="submit" name="checkout" value="1" class="at-btn content-product-right__btn content-product-right__btn--primary w-100" @disabled($product->isOutOfStock())>
                            <span><span class="text-1">{{ __('BUY IT NOW') }}</span><span class="text-2">{{ __('BUY IT NOW') }}</span></span>
                            <i class="icon-arrow-up-right">
                                <svg width="14" height="14" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 0 9.9375 0L3.1875 0C2.77329 0 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/>
                                </svg>
                            </i>
                            </button>
                        </div>
                        @endif
                    </form>

                    <div class="content-product-right__meta row mb-4">
                        <div class="col-md-6">
                            @if($product->sku)
                                <p class="content-product-right__meta-item"><strong>{{ __('SKU:') }}</strong> {{ $product->sku }}</p>
                            @endif
                            @if($product->categories->isNotEmpty())
                                <p class="content-product-right__meta-item">
                                    <strong>{{ __('Category:') }}</strong>
                                    @foreach($product->categories as $cat)
                                        <a href="{{ $cat->url }}">{{ $cat->name }}</a>@if(!$loop->last), @endif
                                    @endforeach
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <ul class="content-product-right__benefits">
                                <li>{{ __('Free shipping') }}</li>
                                <li>{{ __('30 days easy returns') }}</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Description / Reviews tabs — inline in the info column for the
                         grid layout. In the gallery layout they render full-width below. --}}
                    @if($galleryStyle !== 'gallery')
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-tabs'), ['fullWidth' => false])
                    @endif
                </div>
            </div>
        </div>

        @if($galleryStyle === 'gallery')
            {{-- Full-width Description/Reviews tabs for the gallery layout: the info
                 column is short, so the tabs move into their own row spanning the
                 container width instead of leaving half the page empty. --}}
            @php
                // Only give up a quarter of the row to the specification sidebar when there is
                // something to put in it - otherwise the tabs keep the full container width.
                $hasSpecifications = EcommerceHelper::isProductSpecificationEnabled()
                    && $product->getVisibleSpecificationAttributes()->isNotEmpty();
            @endphp
            <div class="row">
                <div class="{{ $hasSpecifications ? 'col-lg-9' : 'col-12' }}">
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-tabs'), ['fullWidth' => true])
                </div>
                @if($hasSpecifications)
                    <div class="col-lg-3">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-specification-sidebar'))
                    </div>
                @endif
            </div>

            @if($product->content)
                {{-- Smooth-scroll to the tabs when "Read more" is clicked, since they
                     now sit further down the page, outside the visible info column. --}}
                <script>
                    (function () {
                        var readMoreLink = document.getElementById('product-read-more-link');
                        var tabsSection = document.getElementById('product-detail-tabs');
                        if (! readMoreLink || ! tabsSection) {
                            return;
                        }

                        readMoreLink.addEventListener('click', function () {
                            setTimeout(function () {
                                // ScrollSmoother translates #smooth-content, so native
                                // smooth scrolling on top of it lands off-target. Hand
                                // the scroll to the smoother when it is running.
                                if (typeof ScrollSmoother !== 'undefined' && ScrollSmoother.get()) {
                                    ScrollSmoother.get().scrollTo(tabsSection, true);

                                    return;
                                }

                                tabsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }, 50);
                        });
                    })();
                </script>
            @endif
        @endif
    </div>
</div>
