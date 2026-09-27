@php Theme::set('hideBreadcrumb', true); @endphp

{{-- Product collection page: hero with collection name + product grid --}}
<div class="sec-1-shop-collection overflow-hidden pt-150">
    <div class="container pb-20">
        <div class="row align-items-end">
            <div class="col-xxl-6">
                @if(isset($collection) && $collection)
                    <h1 class="fz-100 lh-1 fw-600 mb-lg-0 mb-4">{{ $collection->name }}</h1>
                    @if($collection->description)
                        <p class="fz-font-lg neutral-900 mb-0">{{ $collection->description }}</p>
                    @endif
                @else
                    <h1 class="fz-100 lh-1 fw-600 mb-lg-0 mb-4">{{ __('Products') }}</h1>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="sec-2-shop-collection overflow-hidden pt-60 pb-80">
    <div class="container">
        <div class="row">
            @if(isset($products) && $products->isNotEmpty())
                @foreach($products as $product)
                    <div class="product-card col-xxl-3 col-lg-4 col-md-6 col-12 mb-30">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'))
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="fz-font-lg">{{ __('No products found in this collection.') }}</p>
                    <a href="{{ route('public.products') }}" class="at-btn mt-3 d-inline-flex">
                        <span><span class="text-1">{{ __('Browse All Products') }}</span><span class="text-2">{{ __('Browse All Products') }}</span></span>
                    </a>
                </div>
            @endif
        </div>

        @if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
            <div class="mt-5">
                {!! $products->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
        @endif
    </div>
</div>
