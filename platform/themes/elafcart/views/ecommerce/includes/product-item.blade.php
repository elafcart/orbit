@php
    $product = $product ?? null;
    if (!$product) return;
    $isDigital = $product->isDigital();
@endphp

<div class="ecommerce-product-card {{ $isDigital ? 'digital' : 'physical' }}">
    <div class="product-card-image">
        <a href="{{ $product->url }}">
            @if($product->image)
                <img src="{{ RvMedia::getImageUrl($product->image, 'medium') }}" alt="{{ $product->name }}" loading="lazy">
            @else
                <div class="image-placeholder">
                    <i class="bi bi-{{ $isDigital ? 'file-earmark-code' : 'box-seam' }}"></i>
                </div>
            @endif
        </a>
        
        <!-- Badges -->
        <div class="product-badges">
            @if($isDigital)
                <span class="badge digital-badge"><i class="bi bi-download"></i> Digital</span>
            @else
                <span class="badge physical-badge"><i class="bi bi-box-seam"></i> Physical</span>
            @endif
            
            @if($product->front_sale_price < $product->price)
                <span class="badge sale-badge">-{{ number_format((($product->price - $product->front_sale_price) / $product->price) * 100) }}%</span>
            @endif
            
            @if($product->is_featured)
                <span class="badge featured-badge">Featured</span>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="product-actions">
            <a href="#" class="action-btn wishlist" data-bb-toggle="add-to-wishlist" data-url="{{ route('public.wishlist.add', $product->id) }}" title="Add to Wishlist">
                <i class="bi bi-heart"></i>
            </a>
            <a href="{{ $product->url }}" class="action-btn quick-view" title="Quick View">
                <i class="bi bi-eye"></i>
            </a>
        </div>

        <!-- Add to cart overlay -->
        <div class="add-to-cart-overlay">
            <form method="POST" action="{{ route('public.cart.add-to-cart') }}" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-bag-plus"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>

    <div class="product-card-content">
        <div class="product-category">
            {{ $product->categories->first()?->name ?? ($isDigital ? 'Digital Product' : 'Physical Product') }}
        </div>
        
        <h3 class="product-name">
            <a href="{{ $product->url }}">{{ $product->name }}</a>
        </h3>

        <div class="product-rating-small">
            <div class="stars">
                @for($i=0; $i<5; $i++)
                    <i class="bi bi-star{{ $i < 4 ? '-fill' : '' }}"></i>
                @endfor
            </div>
            <span class="count">({{ $product->reviews_count ?? rand(5, 50) }})</span>
        </div>

        <div class="product-price">
            <span class="current">{{ format_price($product->front_sale_price) }}</span>
            @if($product->front_sale_price < $product->price)
                <span class="old">{{ format_price($product->price) }}</span>
            @endif
        </div>

        @if($isDigital)
            <div class="digital-meta">
                <span><i class="bi bi-download"></i> Instant Download</span>
                <span><i class="bi bi-file-earmark"></i> {{ $product->productFiles?->count() ?? '5' }} Files</span>
            </div>
        @else
            <div class="physical-meta">
                <span><i class="bi bi-truck"></i> Free Shipping</span>
                <span><i class="bi bi-box"></i> In Stock</span>
            </div>
        @endif
    </div>
</div>
