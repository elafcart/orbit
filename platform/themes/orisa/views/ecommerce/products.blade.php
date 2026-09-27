@php Theme::set('hideBreadcrumb', true); @endphp

{{-- Products archive: hero header + filter bar + product grid --}}
<div class="sec-1-shop-archive overflow-hidden pt-150">
    <div class="container pb-20">
        <div class="row g-4 align-items-end">
            <div class="col-xxl-3">
                <h1 class="fz-200 lh-1 fw-600 mb-lg-0 mb-4">{{ __('Store') }}</h1>
            </div>
            <div class="col-xxl-8 ms-auto">
                <div class="d-flex flex-wrap gap-4 justify-content-between">
                    <div class="d-flex gap-4 justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="currentColor" aria-hidden="true">
                            <path d="M15 30V15H0L15 0L30 15V30H15Z" fill="currentColor" />
                            <path d="M0 15L15 30H0V15Z" fill="currentColor" />
                        </svg>
                        <div>
                            <h2 class="h6 fw-600 fz-18 mb-0">{{ __('Customer Support') }}</h2>
                            <p>{{ __('Mon - Sat, 10am - 9pm') }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-4 justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none" aria-hidden="true">
                            <path d="M14.3478 16.9565L21.5217 13.0435V3.91304L14.3478 0L7.17391 3.91304L14.3478 8.47826V16.9565Z" fill="currentColor" />
                            <path d="M14.3478 16.9565L7.17391 13.0435L0 16.9565V26.087L7.17391 30V21.5217L14.3478 16.9565Z" fill="currentColor" />
                            <path d="M14.3478 16.9565L21.5217 21.5217L28.6957 16.9565V26.087L21.5217 30L14.3478 26.087V16.9565Z" fill="currentColor" />
                        </svg>
                        <div>
                            <h2 class="h6 fw-600 fz-18 mb-0">{{ __('Easy Returns') }}</h2>
                            <p>{{ __('Returns extended to 60 days') }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-4 justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="30" viewBox="0 0 29 30" fill="none" aria-hidden="true">
                            <path d="M17.1429 10L14.2857 5L17.1429 0L20 5H25.7143L22.8571 10H17.1429Z" fill="currentColor" />
                            <path d="M22.8571 20L20 15L22.8571 10H28.5714L25.7143 15L28.5714 20H22.8571Z" fill="currentColor" />
                            <path d="M14.2857 25L17.1429 20H22.8571L25.7143 25H20L17.1429 30L14.2857 25Z" fill="currentColor" />
                            <path d="M5.71429 20H11.4286L14.2857 25L11.4286 30L8.57143 25H2.85714L5.71429 20Z" fill="currentColor" />
                            <path d="M5.71429 10H11.4286L14.2857 5L11.4286 0L8.57143 5H2.85714L5.71429 10Z" fill="currentColor" />
                            <path d="M5.71429 10H0L2.85714 15L0 20H5.71429L8.57143 15L5.71429 10Z" fill="currentColor" />
                        </svg>
                        <div>
                            <h2 class="h6 fw-600 fz-18 mb-0">{{ __('One-year Warranty') }}</h2>
                            <p>{{ __('No questions asked') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(theme_option('shop_banner_image'))
        <div class="at-banner-thumb overflow-hidden scale-up-img">
            {{ RvMedia::image(theme_option('shop_banner_image'), __('Store'), attributes: ['class' => 'img-cover scale-up', 'data-speed' => '.4']) }}
        </div>
    @endif
</div>

<div class="sec-2-shop-archive overflow-hidden pt-60 pb-80">
    <div class="container">
        <div class="row align-items-end mb-4">
            <div class="col-lg-4 mb-lg-0 mb-3">
                <h2>{{ __('New Arrivals') }}</h2>
                <p class="fz-font-lg neutral-900 mb-0">{{ __('Discover the latest products.') }}</p>
            </div>
            <div class="col-lg-8 ms-auto">
                <div class="d-flex flex-wrap justify-content-end gap-4 align-items-center">
                    @if(isset($categories) && $categories->isNotEmpty())
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a href="{{ route('public.products') }}"
                               class="at-btn btn-sm {{ !request('category') ? 'active' : '' }}">
                                {{ __('All') }}
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ $cat->url }}"
                                   class="at-btn btn-sm {{ request()->url() === $cat->url ? 'active' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <form method="GET" action="{{ request()->url() }}" class="d-flex align-items-center gap-2">
                        @foreach(request()->except('sort-by') as $key => $val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endforeach
                        <select name="sort-by" class="at-select">
                            <option value="latest" {{ request('sort-by') === 'latest' ? 'selected' : '' }}>{{ __('Latest') }}</option>
                            <option value="oldest" {{ request('sort-by') === 'oldest' ? 'selected' : '' }}>{{ __('Oldest') }}</option>
                            <option value="price-asc" {{ request('sort-by') === 'price-asc' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                            <option value="price-desc" {{ request('sort-by') === 'price-desc' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @if(isset($products) && $products->isNotEmpty())
                @foreach($products as $product)
                    <div class="product-card col-xxl-3 col-lg-4 col-md-6 col-12 mb-30">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'))
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="fz-font-lg">{{ __('No products found.') }}</p>
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

{{-- niceSelect hides the native <select> and re-emits selection via jQuery's trigger("change"),
     which does not fire an inline onchange attribute; bind the submit handler through jQuery instead. --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.jQuery) {
            jQuery(document).on('change', 'select[name="sort-by"]', function () {
                this.form.submit();
            });
        }
    });
</script>
