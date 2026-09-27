@php
    Theme::set('hideBreadcrumb', true);
    $product = $product ?? get_product_by_slug(request()->route('slug'));
@endphp

@include(Theme::getThemeNamespace('views.ecommerce.includes.product-detail'))

{{-- Scrolling ticker --}}
<div class="sec-2-shop-details overflow-hidden pt-60">
    <div class="py-5 carouselTicker carouselTicker-right">
        <ul class="d-flex align-items-center justify-content-center gap-4 carouselTicker__list scroll-move-left">
            @foreach (['Smart wear', 'Casual cool', 'Luxe touch', 'Bold fashion', 'Modern fit', 'Feel trendy', 'New vibes', 'Urban style', 'Fresh looks', 'Daily wear', 'Street ready'] as $tag)
                <li class="d-flex align-items-center gap-4">
                    <h5 class="mb-0 text-nowrap">{{ __($tag) }}</h5>
                    <svg class="scroll-rotate" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M20 0C20.3015 10.9184 29.0816 19.6985 40 20C29.0816 20.3015 20.3015 29.0816 20 40C19.6985 29.0816 10.9184 20.3015 0 20C10.9184 19.6985 19.6985 10.9184 20 0Z" fill="currentColor"/>
                    </svg>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Product content info --}}
@php
    $galleryImages = array_slice($product->images ?: [], 0, 4);
@endphp
<div class="sec-3-shop-details-1 pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                {{-- Full description is rendered once in the "Description" tab
                     (see includes/product-detail.blade.php). Do not duplicate it here. --}}

                {{-- Product details grid --}}
                <div class="row g-4 mb-50">
                    <div class="col-md-6">
                        <h5 class="fw-600 mb-20">{{ __('Product Details') }}</h5>
                        <ul class="list-unstyled d-flex flex-column gap-2">
                            @if($product->sku)
                                <li class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="neutral-500">{{ __('SKU') }}</span>
                                    <span class="fw-600">{{ $product->sku }}</span>
                                </li>
                            @endif
                            @if($product->brand)
                                <li class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="neutral-500">{{ __('Brand') }}</span>
                                    <span class="fw-600">{{ $product->brand->name }}</span>
                                </li>
                            @endif
                            @if($product->categories->isNotEmpty())
                                <li class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="neutral-500">{{ __('Category') }}</span>
                                    <span class="fw-600">{{ $product->categories->pluck('name')->implode(', ') }}</span>
                                </li>
                            @endif
                            @if($product->weight)
                                <li class="d-flex justify-content-between border-bottom pb-2">
                                    <span class="neutral-500">{{ __('Weight') }}</span>
                                    <span class="fw-600">{{ $product->weight }}g</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @php
                        $infoTitle = theme_option('product_detail_info_title', __('Shipping & Returns'));
                        $infoItems = theme_option('product_detail_info_items');
                        $infoItems = $infoItems ? (is_string($infoItems) ? json_decode($infoItems, true) : $infoItems) : [];
                    @endphp
                    @if($infoTitle || ! empty($infoItems))
                        <div class="col-md-6">
                            @if($infoTitle)
                                <h5 class="fw-600 mb-20">{{ $infoTitle }}</h5>
                            @endif
                            @if(! empty($infoItems))
                                <ul class="list-unstyled d-flex flex-column gap-3">
                                    @foreach($infoItems as $item)
                                        @if(! empty($item[0]['value'] ?? $item['text'] ?? ''))
                                            <li class="d-flex align-items-start gap-2">
                                                <svg class="flex-shrink-0 mt-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                                                <span>{{ $item[0]['value'] ?? $item['text'] ?? '' }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Gallery row --}}
                @if(count($galleryImages) > 2)
                    <div class="row g-3 mb-50">
                        @foreach(array_slice($galleryImages, 2) as $galleryImg)
                            <div class="col-md-6">
                                <div class="rounded-4 overflow-hidden">
                                    {{ RvMedia::image($galleryImg, $product->name, attributes: ['class' => 'w-100']) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Share --}}
                <div class="d-flex align-items-center py-3 border-top">
                    <span class="fw-bold me-2">{{ __('Share:') }}</span>
                    {!! Theme::renderSocialSharing($product->url, $product->description, $product->image) !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Related products --}}
@php
    $relatedProducts = get_related_products($product);
@endphp
@if ($relatedProducts && $relatedProducts->isNotEmpty())
<div class="sec-4-shop-details-1 overflow-hidden pt-100 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h4 class="fw-600 mb-40">{{ __('Related Products') }}</h4>
                <div class="row g-4">
                    @foreach ($relatedProducts->take(4) as $relatedProduct)
                        <div class="product-card col-md-6">
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
