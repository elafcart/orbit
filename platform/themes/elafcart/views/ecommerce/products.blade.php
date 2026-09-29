<section class="ecommerce-products-page section-padding">
    <div class="container">
        <!-- Header -->
        <div class="products-header">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="page-title">{{ $category->name ?? 'All Products' }}</h1>
                    <p class="page-desc">Discover our collection of {{ $products->total() }} products - Digital & Physical</p>
                </div>
                <div class="col-lg-6">
                    <div class="products-filters">
                        <div class="filter-tabs">
                            <a href="{{ route('public.products') }}" class="filter-tab {{ !request()->get('type') ? 'active' : '' }}">All Products</a>
                            <a href="{{ route('public.products') }}?type=digital" class="filter-tab {{ request()->get('type') == 'digital' ? 'active' : '' }}">
                                <i class="bi bi-download"></i> Digital
                            </a>
                            <a href="{{ route('public.products') }}?type=physical" class="filter-tab {{ request()->get('type') == 'physical' ? 'active' : '' }}">
                                <i class="bi bi-box-seam"></i> Physical
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4 mt-2">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $product])
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-products">
                        <i class="bi bi-bag-x"></i>
                        <h4>No products found</h4>
                        <p>Try adjusting your filters or browse all products</p>
                        <a href="{{ route('public.products') }}" class="btn btn-primary rounded-pill mt-3">Browse All Products</a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {!! $products->withQueryString()->links() !!}
        </div>
    </div>
</section>
