@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section class="section pt-10 sm:pt-14">
    <div class="container-shell">
        {{-- Gallery + buy box: plugin-rendered (variations, options, add-to-cart) --}}
        @include(EcommerceHelper::viewPath('includes.product-detail'))

        {{-- Content tabs --}}
        <div class="mt-14" data-animate="fade-up">
            <div class="flex flex-wrap gap-2 border-b border-slate-200 dark:border-slate-800" role="tablist">
                <button
                    type="button"
                    data-sx-tab="#sx-tab-description"
                    aria-selected="true"
                    class="sx-tab -mb-px border-b-2 border-brand-600 px-4 py-2.5 text-sm font-semibold text-brand-600 dark:text-brand-400"
                >
                    {{ __('Description') }}
                </button>

                @if (EcommerceHelper::isProductSpecificationEnabled() && $product->specificationAttributes->where('pivot.hidden', false)->isNotEmpty())
                    <button
                        type="button"
                        data-sx-tab="#sx-tab-specification"
                        aria-selected="false"
                        class="sx-tab -mb-px border-b-2 border-transparent px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:text-brand-600 dark:text-slate-400"
                    >
                        {{ __('Specification') }}
                    </button>
                @endif

                @if (EcommerceHelper::isReviewEnabled())
                    <button
                        type="button"
                        data-sx-tab="#sx-tab-reviews"
                        aria-selected="false"
                        class="sx-tab -mb-px border-b-2 border-transparent px-4 py-2.5 text-sm font-semibold text-slate-500 transition hover:text-brand-600 dark:text-slate-400"
                    >
                        {{ __('Reviews') }} @if ($product->reviews_count) ({{ $product->reviews_count }}) @endif
                    </button>
                @endif
            </div>

            <div class="pt-8">
                <div id="sx-tab-description" class="sx-tab-panel">
                    <div class="entry-content mx-auto max-w-4xl">
                        {!! BaseHelper::clean($product->content) !!}
                    </div>
                </div>

                @if (EcommerceHelper::isProductSpecificationEnabled() && $product->specificationAttributes->where('pivot.hidden', false)->isNotEmpty())
                    <div id="sx-tab-specification" class="sx-tab-panel hidden">
                        <div class="mx-auto max-w-4xl">
                            @include(EcommerceHelper::viewPath('includes.product-specification'))
                        </div>
                    </div>
                @endif

                @if (EcommerceHelper::isReviewEnabled())
                    <div id="sx-tab-reviews" class="sx-tab-panel hidden">
                        <div class="mx-auto max-w-4xl" id="product-reviews">
                            @include(EcommerceHelper::viewPath('includes.reviews'))
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Related products --}}
        @php
            $relatedProducts = get_related_products($product);
        @endphp

        @if ($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <h2 class="section-title" data-animate="fade-up">{{ __('Related Products') }}</h2>

                <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-animate="stagger" data-stagger="0.08">
                    @foreach ($relatedProducts as $relatedProduct)
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $relatedProduct])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
