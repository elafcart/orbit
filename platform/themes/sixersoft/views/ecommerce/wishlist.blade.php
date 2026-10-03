@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section class="section">
    <div class="container-shell">
        <header data-animate="fade-up">
            <span class="section-eyebrow">{{ __('Your saved items') }}</span>
            <h1 class="section-title">{{ __('Wishlist') }}</h1>
        </header>

        @if (! isset($products) || $products->isEmpty())
            <div class="card mt-10 p-12">
                @include(EcommerceHelper::viewPath('includes.empty-state'), [
                    'icon' => 'ti ti-heart',
                    'title' => __('Your wishlist is empty'),
                    'route' => route('public.products'),
                ])
            </div>
        @else
            <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" data-animate="stagger" data-stagger="0.08">
                @foreach ($products as $product)
                    <div class="relative">
                        @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $product])

                        @if ($canRemoveWishlist ?? true)
                            <button
                                type="button"
                                data-bb-toggle="remove-from-wishlist"
                                data-url="{{ route('public.wishlist.remove', $product->id) }}"
                                aria-label="{{ __('Remove from wishlist') }}"
                                class="absolute top-3 right-3 z-10 flex size-9 items-center justify-center rounded-full bg-white/90 text-rose-600 shadow transition hover:bg-rose-600 hover:text-white dark:bg-slate-900/90"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M18 6 6 18M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
