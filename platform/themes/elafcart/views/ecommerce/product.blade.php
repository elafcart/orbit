@php
    Theme::set('hideBreadcrumb', true);
@endphp

<article class="ecommerce-product-single">
    <!-- Product Hero -->
    <section class="product-hero">
        <div class="container">
            <div class="row g-5 align-items-start">
                <!-- Images -->
                <div class="col-lg-6">
                    <div class="product-images">
                        @php
                            $images = $product->images ?: [];
                            if (empty($images) && $product->image) {
                                $images = [$product->image];
                            }
                        @endphp
                        
                        <div class="product-main-image">
                            @if($product->image)
                                <img src="{{ RvMedia::getImageUrl($product->image) }}" alt="{{ $product->name }}" id="mainProductImage">
                                @if($product->isOutOfStock())
                                    <span class="stock-badge out-of-stock">Out of Stock</span>
                                @else
                                    @if($product->product_type && $product->product_type->getValue() === 'digital')
                                        <span class="product-type-badge digital"><i class="bi bi-download"></i> Digital Product</span>
                                    @else
                                        <span class="product-type-badge physical"><i class="bi bi-box-seam"></i> Physical Product</span>
                                    @endif
                                @endif
                                @if($product->front_sale_price < $product->price)
                                    <span class="sale-badge">-{{ number_format((($product->price - $product->front_sale_price) / $product->price) * 100) }}%</span>
                                @endif
                            @else
                                <div class="product-image-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>
                        
                        @if(count($images) > 1)
                            <div class="product-thumbnails">
                                @foreach($images as $img)
                                    <div class="thumb-item {{ $loop->first ? 'active' : '' }}" data-image="{{ RvMedia::getImageUrl($img) }}">
                                        <img src="{{ RvMedia::getImageUrl($img, 'thumb') }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <div class="product-meta-top">
                            @if($product->categories->isNotEmpty())
                                <span class="product-category">{{ $product->categories->first()->name }}</span>
                            @endif
                            @if($product->brand)
                                <span class="product-brand">by {{ $product->brand->name }}</span>
                            @endif
                            <span class="product-sku">SKU: {{ $product->sku ?: 'N/A' }}</span>
                        </div>

                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="product-rating">
                            <div class="stars">
                                @for($i=0; $i<5; $i++)
                                    <i class="bi bi-star{{ $i < floor($product->reviews_avg ?? 5) ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <span class="rating-count">({{ $product->reviews_count ?? 12 }} reviews)</span>
                            <span class="product-views"><i class="bi bi-eye"></i> {{ number_format($product->views ?? 0) }} views</span>
                        </div>

                        <div class="product-price">
                            <span class="current-price">{{ format_price($product->front_sale_price) }}</span>
                            @if($product->front_sale_price < $product->price)
                                <span class="old-price">{{ format_price($product->price) }}</span>
                            @endif
                        </div>

                        @if($product->description)
                            <div class="product-short-desc">
                                {!! BaseHelper::clean($product->description) !!}
                            </div>
                        @endif

                        <!-- Digital Product Info -->
                        @if($product->isDigital())
                            <div class="digital-info-box">
                                <h6><i class="bi bi-info-circle"></i> Digital Product Includes:</h6>
                                <ul>
                                    <li><i class="bi bi-check2"></i> Instant download after purchase</li>
                                    <li><i class="bi bi-check2"></i> Lifetime updates (if applicable)</li>
                                    <li><i class="bi bi-check2"></i> Commercial license included</li>
                                    <li><i class="bi bi-check2"></i> No shipping required</li>
                                </ul>
                                @if($product->productFiles && $product->productFiles->count())
                                    <div class="file-info">
                                        <i class="bi bi-file-earmark"></i> {{ $product->productFiles->count() }} files included
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="physical-info-box">
                                <div class="info-row">
                                    <span><i class="bi bi-truck"></i> Free shipping on orders over $50</span>
                                </div>
                                <div class="info-row">
                                    <span><i class="bi bi-arrow-return-left"></i> 30 days easy returns</span>
                                </div>
                                <div class="info-row">
                                    <span><i class="bi bi-shield-check"></i> Secure payment</span>
                                </div>
                            </div>
                        @endif

                        <!-- Variations & Options -->
                        <form class="product-form add-to-cart-form" data-bb-toggle="product-form" method="POST" action="{{ route('public.cart.add-to-cart') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            
                            @if($product->variations()->count() > 0 || $product->is_variation)
                                <div class="product-variations">
                                    {!! render_product_swatches($product) !!}
                                </div>
                            @endif

                            {!! render_product_options($product) !!}

                            <div class="product-actions">
                                <div class="quantity-selector">
                                    <label>Quantity</label>
                                    <div class="qty-control">
                                        <button type="button" class="qty-btn minus"><i class="bi bi-dash"></i></button>
                                        <input type="number" name="qty" value="1" min="1" class="qty-input">
                                        <button type="button" class="qty-btn plus"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>

                                <div class="action-buttons">
                                    <button type="submit" name="add-to-cart" class="btn btn-primary btn-lg add-to-cart-btn" @disabled($product->isOutOfStock())>
                                        <i class="bi bi-bag-plus"></i>
                                        @if($product->isDigital())
                                            Buy Now - Instant Download
                                        @else
                                            Add to Cart
                                        @endif
                                    </button>
                                    <button type="submit" name="checkout" value="1" class="btn btn-dark btn-lg buy-now-btn" @disabled($product->isOutOfStock())>
                                        Buy Now
                                    </button>
                                </div>

                                <div class="secondary-actions">
                                    <a href="#" class="action-link wishlist-btn" data-bb-toggle="add-to-wishlist" data-url="{{ route('public.wishlist.add', $product->id) }}">
                                        <i class="bi bi-heart"></i> Add to Wishlist
                                    </a>
                                    <a href="#" class="action-link compare-btn">
                                        <i class="bi bi-arrow-left-right"></i> Compare
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Meta -->
                        <div class="product-meta-bottom">
                            @if($product->categories->isNotEmpty())
                                <div class="meta-item">
                                    <strong>Category:</strong>
                                    @foreach($product->categories as $cat)
                                        <a href="{{ $cat->url }}">{{ $cat->name }}</a>@if(!$loop->last), @endif
                                    @endforeach
                                </div>
                            @endif
                            @if($product->tags->isNotEmpty())
                                <div class="meta-item">
                                    <strong>Tags:</strong>
                                    @foreach($product->tags as $tag)
                                        <a href="{{ $tag->url }}">{{ $tag->name }}</a>@if(!$loop->last), @endif
                                    @endforeach
                                </div>
                            @endif
                            <div class="meta-item share">
                                <strong>Share:</strong>
                                <div class="share-links">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($product->url) }}" target="_blank"><i class="bi bi-facebook"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($product->url) }}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($product->url) }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($product->url) }}" target="_blank"><i class="bi bi-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Tabs -->
    <section class="product-tabs-section">
        <div class="container">
            <ul class="nav nav-tabs product-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-description">Description</button>
                </li>
                @if($product->isDigital() && $product->productFiles && $product->productFiles->count())
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-files">Files Included</button>
                    </li>
                @endif
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-specs">Specifications</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-reviews">Reviews ({{ $product->reviews_count ?? 0 }})</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-faq">FAQ</button>
                </li>
            </ul>

            <div class="tab-content product-tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <div class="ck-content">
                        {!! BaseHelper::clean($product->content) !!}
                    </div>
                </div>
                
                @if($product->isDigital())
                    <div class="tab-pane fade" id="tab-files">
                        <div class="files-list">
                            @if($product->productFiles && $product->productFiles->count())
                                @foreach($product->productFiles as $file)
                                    <div class="file-item">
                                        <div class="file-icon"><i class="bi bi-file-earmark-zip"></i></div>
                                        <div class="file-info">
                                            <h6>{{ $file->file_name ?? 'Download File' }}</h6>
                                            <span>{{ $file->file_size ?? 'Unknown size' }}</span>
                                        </div>
                                        <div class="file-type">
                                            <span class="badge bg-primary">Digital</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Files will be available after purchase. You'll receive instant download link via email.</p>
                                <ul class="mt-3">
                                    <li>High-quality source files</li>
                                    <li>Documentation included</li>
                                    <li>Free updates</li>
                                    <li>Commercial license</li>
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="tab-pane fade" id="tab-specs">
                    <div class="specs-grid">
                        <div class="spec-item">
                            <span class="spec-label">Product Type</span>
                            <span class="spec-value">{{ $product->isDigital() ? 'Digital Product' : 'Physical Product' }}</span>
                        </div>
                        @if($product->sku)
                            <div class="spec-item">
                                <span class="spec-label">SKU</span>
                                <span class="spec-value">{{ $product->sku }}</span>
                            </div>
                        @endif
                        @if(!$product->isDigital() && $product->weight)
                            <div class="spec-item">
                                <span class="spec-label">Weight</span>
                                <span class="spec-value">{{ $product->weight }}g</span>
                            </div>
                        @endif
                        <div class="spec-item">
                            <span class="spec-label">Availability</span>
                            <span class="spec-value">{{ $product->isOutOfStock() ? 'Out of Stock' : 'In Stock' }}</span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-reviews">
                    <div class="reviews-section">
                        <h4>Customer Reviews</h4>
                        <p>Reviews will appear here. Enable reviews in ecommerce settings.</p>
                        {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $product) !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-faq">
                    <div class="faq-section">
                        @if($product->isDigital())
                            <div class="faq-item">
                                <h6>How do I download my files?</h6>
                                <p>After purchase, you'll receive an email with download links. You can also access your files from your account dashboard under "Digital Products".</p>
                            </div>
                            <div class="faq-item">
                                <h6>Do I get lifetime updates?</h6>
                                <p>Yes, most digital products include lifetime updates. Check product description for specific details.</p>
                            </div>
                            <div class="faq-item">
                                <h6>Can I use this for commercial projects?</h6>
                                <p>Yes, commercial license is included. You can use the product in your client projects.</p>
                            </div>
                        @else
                            <div class="faq-item">
                                <h6>How long does shipping take?</h6>
                                <p>Standard shipping takes 3-5 business days. Express shipping available at checkout.</p>
                            </div>
                            <div class="faq-item">
                                <h6>What's your return policy?</h6>
                                <p>30 days easy returns. Product must be in original condition.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @php
        $relatedProducts = get_related_products($product, 4);
    @endphp
    @if($relatedProducts && $relatedProducts->count())
        <section class="related-products section-padding bg-light">
            <div class="container">
                <h3 class="section-title text-center mb-5">You May Also Like</h3>
                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-lg-3 col-md-6">
                            @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $related])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</article>
