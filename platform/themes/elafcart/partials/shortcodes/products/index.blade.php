@php
    $title = $shortcode->title ?? 'My Products';
    $subtitle = $shortcode->subtitle ?? 'Shop';
    $type = $shortcode->product_type ?? 'all'; // all, digital, physical
    $limit = $shortcode->limit ?? 8;
    
    $products = collect();
    if (is_plugin_active('ecommerce')) {
        $query = \Botble\Ecommerce\Models\Product::wherePublished()->latest();
        
        if ($type === 'digital') {
            $query->where('product_type', 'digital');
        } elseif ($type === 'physical') {
            $query->where(function($q) {
                $q->where('product_type', 'physical')->orWhereNull('product_type');
            });
        }
        
        $products = $query->limit($limit)->get();
    }

    // Fallback dummy products
    if ($products->isEmpty()) {
        $allDummy = [
            (object)['name' => 'Portfolio Template - React', 'price' => 49, 'sale_price' => 39, 'type' => 'digital', 'category' => 'Templates', 'image' => null, 'url' => '#'],
            (object)['name' => 'UI Kit - Figma + Code', 'price' => 79, 'sale_price' => 59, 'type' => 'digital', 'category' => 'UI Kits', 'image' => null, 'url' => '#'],
            (object)['name' => 'Laravel SaaS Boilerplate', 'price' => 149, 'sale_price' => 99, 'type' => 'digital', 'category' => 'Boilerplates', 'image' => null, 'url' => '#'],
            (object)['name' => 'Branded T-Shirt - Black', 'price' => 29, 'sale_price' => 29, 'type' => 'physical', 'category' => 'Merch', 'image' => null, 'url' => '#'],
            (object)['name' => 'Developer Hoodie', 'price' => 59, 'sale_price' => 49, 'type' => 'physical', 'category' => 'Merch', 'image' => null, 'url' => '#'],
            (object)['name' => 'Notion Template Pack', 'price' => 19, 'sale_price' => 12, 'type' => 'digital', 'category' => 'Templates', 'image' => null, 'url' => '#'],
            (object)['name' => 'Desk Mat - Large', 'price' => 35, 'sale_price' => 35, 'type' => 'physical', 'category' => 'Accessories', 'image' => null, 'url' => '#'],
            (object)['name' => 'Icon Pack - 500 Icons', 'price' => 25, 'sale_price' => 19, 'type' => 'digital', 'category' => 'Icons', 'image' => null, 'url' => '#'],
        ];
        
        if ($type === 'digital') {
            $allDummy = array_filter($allDummy, fn($p) => $p->type === 'digital');
        } elseif ($type === 'physical') {
            $allDummy = array_filter($allDummy, fn($p) => $p->type === 'physical');
        }
        
        $products = collect(array_slice($allDummy, 0, $limit));
    }
@endphp

<section class="products-shortcode-section section-padding {{ $type !== 'all' ? 'bg-light' : '' }}" id="{{ $type }}-products">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="section-subtitle">
                    @if($type === 'digital')
                        <i class="bi bi-download"></i> Digital Products
                    @elseif($type === 'physical')
                        <i class="bi bi-box-seam"></i> Physical Products
                    @else
                        {{ $subtitle }}
                    @endif
                </span>
                <h2 class="section-title mb-0">{{ $title }}</h2>
                @if($shortcode->description)
                    <p class="section-desc mt-2">{{ $shortcode->description }}</p>
                @endif
            </div>
            <div class="d-none d-md-flex gap-2">
                <a href="{{ route('public.products') }}?type={{ $type }}" class="btn btn-outline-dark rounded-pill">View All <i class="bi bi-arrow-up-right ms-2"></i></a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($products as $index => $product)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                    @if(isset($product->id))
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $product])
                    @else
                        {{-- Dummy product card --}}
                        <div class="ecommerce-product-card {{ $product->type }}">
                            <div class="product-card-image">
                                <a href="{{ $product->url }}">
                                    <div class="image-placeholder">
                                        <i class="bi bi-{{ $product->type === 'digital' ? 'file-earmark-code' : 'box-seam' }}"></i>
                                    </div>
                                </a>
                                <div class="product-badges">
                                    @if($product->type === 'digital')
                                        <span class="badge digital-badge"><i class="bi bi-download"></i> Digital</span>
                                    @else
                                        <span class="badge physical-badge"><i class="bi bi-box-seam"></i> Physical</span>
                                    @endif
                                    @if($product->sale_price < $product->price)
                                        <span class="badge sale-badge">-{{ number_format((($product->price - $product->sale_price)/$product->price)*100) }}%</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-card-content">
                                <div class="product-category">{{ $product->category }}</div>
                                <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                <div class="product-price">
                                    <span class="current">${{ $product->sale_price }}</span>
                                    @if($product->sale_price < $product->price)
                                        <span class="old">${{ $product->price }}</span>
                                    @endif
                                </div>
                                <div class="{{ $product->type }}-meta">
                                    @if($product->type === 'digital')
                                        <span><i class="bi bi-download"></i> Instant Download</span>
                                    @else
                                        <span><i class="bi bi-truck"></i> Free Shipping</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5 d-md-none">
            <a href="#" class="btn btn-outline-dark rounded-pill">View All {{ ucfirst($type) }} Products</a>
        </div>
    </div>
</section>
