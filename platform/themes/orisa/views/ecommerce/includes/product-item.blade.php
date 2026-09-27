@php
    $discountPercent = \Theme\Orisa\Support\ThemeHelper::saleDiscountPercent($product);
@endphp
<div class="product-card__inner">
    <div class="product-card__thumb hover-effect-1">
        @if($discountPercent > 0)
            <span class="product-card__badge product-card__badge--sale">{{ __('Save :percent%', ['percent' => $discountPercent]) }}</span>
        @endif
        <a href="{{ $product->url }}" class="product-card__img-link">
            {{ RvMedia::image($product->image, $product->name, 'product-thumb', attributes: ['class' => 'product-card__img']) }}
        </a>
    </div>
    <div class="product-card__content">
        @if($product->brand_id && $product->brand)
            <p class="product-card__brand">{{ strtoupper($product->brand->name) }}</p>
        @endif
        <div class="product-card__row">
            <h3 class="h6 product-card__title">
                <a href="{{ $product->url }}" class="product-card__title-link">{{ $product->name }}</a>
            </h3>
            <p class="product-card__price">
                {{ format_price($product->front_sale_price) }}
                @if($discountPercent > 0)
                    {{-- The badge only means something next to the price it is discounted from. --}}
                    <span class="product-card__price-old">{{ format_price($product->price) }}</span>
                @endif
            </p>
        </div>
    </div>
</div>
