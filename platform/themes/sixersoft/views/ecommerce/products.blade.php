@php
    // Shared product listing — also included by product-category / product-tag /
    // brand / search views, which set $listingHeading before including this file.
    $listingHeading ??= __('All Products');
@endphp

@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section class="section">
    <div class="container-shell">
        <header class="flex flex-wrap items-end justify-between gap-4" data-animate="fade-up">
            <div>
                <span class="section-eyebrow">{{ __('Shop') }}</span>
                <h1 class="section-title">{{ $listingHeading }}</h1>
                @if (isset($products) && method_exists($products, 'total'))
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __(':count products', ['count' => $products->total()]) }}</p>
                @endif
            </div>
        </header>

        @if (! isset($products) || $products->isEmpty())
            <div class="card mt-10 p-12">
                @include(EcommerceHelper::viewPath('includes.empty-state'), ['icon' => 'ti ti-shopping-bag'])
            </div>
        @else
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" data-animate="stagger" data-stagger="0.08">
                @foreach ($products as $product)
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $product])
                @endforeach
            </div>

            @if (method_exists($products, 'links'))
                {!! $products->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            @endif
        @endif
    </div>
</section>

@include(EcommerceHelper::viewPath('includes.quick-shop-modal'))
@include(EcommerceHelper::viewPath('includes.quick-view-modal'))
