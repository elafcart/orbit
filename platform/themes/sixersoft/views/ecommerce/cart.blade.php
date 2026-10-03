@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section data-bb-toggle="cart-content" class="section pt-10 sm:pt-14">
    <div class="container-shell">
        @if ($products->isNotEmpty())
            <header data-animate="fade-up">
                <span class="section-eyebrow">{{ __('Shop') }}</span>
                <h1 class="section-title">{{ __('Your Cart') }}</h1>
            </header>

            <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_360px]">
                {{-- Cart items --}}
                <div>
                    <x-core::form method="POST" :url="route('public.cart.update')" class="overflow-x-auto">
                        <table data-bb-value="cart-table" class="w-full min-w-[560px] text-sm">
                            <thead>
                                <tr class="border-b border-slate-200 text-start text-xs font-semibold tracking-wider text-slate-500 uppercase dark:border-slate-800 dark:text-slate-400">
                                    <th class="py-3 pe-4 text-start">{{ __('Product') }}</th>
                                    <th class="py-3 pe-4 text-start">{{ __('Price') }}</th>
                                    <th class="py-3 pe-4 text-start">{{ __('Quantity') }}</th>
                                    <th class="py-3 pe-4 text-start">{{ __('Total') }}</th>
                                    <th class="py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::instance('cart')->content() as $key => $cartItem)
                                    @php
                                        $product = $products->find($cartItem->id);
                                    @endphp

                                    @continue(empty($product))

                                    <tr data-bb-value="cart-row-{{ $cartItem->rowId }}" class="border-b border-slate-200 align-middle dark:border-slate-800">
                                        <input type="hidden" name="items[{{ $key }}][rowId]" value="{{ $cartItem->rowId }}">

                                        <td class="py-4 pe-4">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ $product->original_product->url }}" class="block size-16 shrink-0 overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-800">
                                                    {{ RvMedia::image($cartItem->options['image'], $product->original_product->name, 'thumb') }}
                                                </a>
                                                <div>
                                                    {!! apply_filters('ecommerce_cart_before_item_content', null, $cartItem) !!}

                                                    <a href="{{ $product->original_product->url }}" class="font-semibold text-slate-900 transition hover:text-brand-600 dark:text-white">
                                                        {{ $product->original_product->name }}
                                                    </a>
                                                    <span @class(['block text-xs', 'text-rose-600' => $product->isOutOfStock(), 'text-emerald-600' => ! $product->isOutOfStock()])>
                                                        @if ($product->isOutOfStock())
                                                            ({{ __('Out of Stock') }})
                                                        @else
                                                            ({{ __('In Stock') }})
                                                        @endif
                                                    </span>

                                                    @if (is_plugin_active('marketplace') && $product->original_product->store?->id)
                                                        <div class="mt-0.5 text-xs text-slate-500">
                                                            {{ __('Vendor') }}:
                                                            <a href="{{ $product->original_product->store->url }}" class="font-medium hover:text-brand-600">{{ $product->original_product->store->name }}</a>
                                                        </div>
                                                    @endif

                                                    @if (! empty($cartItem->options['attributes']))
                                                        <div class="mt-0.5 text-xs text-slate-500">{{ $cartItem->options['attributes'] }}</div>
                                                    @endif

                                                    @if (EcommerceHelper::isEnabledProductOptions() && ! empty($cartItem->options['options']))
                                                        {!! render_product_options_html($cartItem->options['options'], $product->price()->getPrice()) !!}
                                                    @endif

                                                    @include(
                                                        EcommerceHelper::viewPath('includes.cart-item-options-extras'),
                                                        ['options' => $cartItem->options]
                                                    )

                                                    {!! apply_filters('ecommerce_cart_after_item_content', null, $cartItem) !!}
                                                </div>
                                            </div>
                                        </td>

                                        <td data-bb-value="cart-product-price-text" class="py-4 pe-4">
                                            @include(EcommerceHelper::viewPath('includes.product-price'), [
                                                'priceWrapperClassName' => 'bb-product-price',
                                                'priceClassName' => 'bb-product-price-text font-medium text-slate-900 dark:text-white',
                                                'isDisplayPriceOriginal' => false,
                                            ])
                                        </td>

                                        <td data-bb-value="cart-product-quantity" class="py-4 pe-4">
                                            @include(EcommerceHelper::viewPath('includes.cart-quantity'))
                                        </td>

                                        <td data-bb-value="cart-product-total-price" class="bb-product-price py-4 pe-4">
                                            <span class="bb-product-price-text font-semibold text-slate-900 dark:text-white">{{ format_price($cartItem->price * $cartItem->qty) }}</span>
                                        </td>

                                        <td class="py-4 text-end">
                                            <button
                                                type="button"
                                                class="flex size-9 items-center justify-center rounded-full text-slate-400 transition hover:bg-rose-50 hover:text-rose-600 dark:hover:bg-rose-950/40"
                                                data-url="{{ route('public.cart.remove', $cartItem->rowId) }}"
                                                data-bb-toggle="remove-from-cart"
                                                {!! EcommerceHelper::jsAttributes('remove-from-cart', $product, ['data-product-quantity' => $cartItem->qty]) !!}
                                                aria-label="{{ __('Remove from cart') }}"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-core::form>

                    {{-- Coupon --}}
                    <div class="mt-6">
                        <x-core::form :url="route('public.coupon.apply')" method="post" data-bb-toggle="coupon-form" id="coupon-form" class="flex max-w-md gap-2">
                            <input
                                type="text"
                                name="coupon_code"
                                value="{{ BaseHelper::stringify(old('coupon_code', session('applied_coupon_code'))) }}"
                                placeholder="{{ __('Enter coupon code') }}"
                                class="w-full rounded-full border border-slate-300 bg-transparent px-5 py-2.5 text-sm focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 focus:outline-none dark:border-slate-700 dark:text-white"
                            >
                            <button type="submit" data-bb-toggle="coupon-form-btn" class="btn btn-outline shrink-0 !py-2.5" @disabled(session('applied_coupon_code'))>
                                {{ __('Apply') }}
                            </button>
                        </x-core::form>
                    </div>
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="card sticky top-24 p-6">
                        <h2 class="text-base font-semibold">{{ __('Order Summary') }}</h2>

                        <div class="mt-4 space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="font-semibold">{{ __('Subtotal') }}</span>
                                <span data-bb-value="cart-subtotal" class="font-semibold">{{ format_price(Cart::instance('cart')->rawSubTotal()) }}</span>
                            </div>

                            {!! apply_filters('ecommerce_cart_after_subtotal', null, Cart::instance('cart')->products()) !!}

                            @if (EcommerceHelper::isTaxEnabled())
                                <div class="flex items-center justify-between text-slate-500 dark:text-slate-400">
                                    <span>{{ __('Tax') }}</span>
                                    <span data-bb-value="cart-tax">{{ format_price(Cart::instance('cart')->rawTax()) }}</span>
                                </div>
                            @endif

                            @if ($couponDiscountAmount > 0 && session('applied_coupon_code'))
                                <div class="flex items-center justify-between text-emerald-600">
                                    <div>
                                        {{ __('Coupon') }}
                                        <span class="text-xs">({{ session('applied_coupon_code') }})</span>
                                        <a class="ms-1 text-xs text-rose-600 underline" data-bb-toggle="remove-coupon" href="{{ route('public.coupon.remove') }}">{{ __('Remove') }}</a>
                                    </div>
                                    <span data-bb-value="cart-coupon-discount-amount">{{ format_price($couponDiscountAmount) }}</span>
                                </div>
                            @endif

                            @if ($promotionDiscountAmount)
                                <div class="flex items-center justify-between text-emerald-600">
                                    <span>{{ __('Promotion') }}</span>
                                    <span data-bb-value="cart-promotion-discount-amount">{{ format_price($promotionDiscountAmount) }}</span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between border-t border-slate-200 pt-3 text-base font-bold dark:border-slate-800">
                                <span>{{ __('Total') }}</span>
                                <span data-bb-value="cart-total">
                                    {{ ($promotionDiscountAmount + $couponDiscountAmount) > Cart::instance('cart')->rawTotal() ? format_price(0) : format_price(Cart::instance('cart')->rawTotal() - $promotionDiscountAmount - $couponDiscountAmount) }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-400">{{ __('Shipping fees not included') }}</p>
                        </div>

                        <a href="{{ route('public.checkout.information', OrderHelper::getOrderSessionToken()) }}" data-bb-toggle="cart-checkout" class="btn btn-primary mt-5 w-full">
                            {{ __('Proceed to Checkout') }}
                        </a>

                        <a href="{{ route('public.products') }}" data-bb-toggle="continue-shopping" class="mt-3 block text-center text-sm font-medium text-brand-600 hover:underline dark:text-brand-400">
                            {{ __('Continue Shopping') }}
                        </a>
                    </div>
                </aside>
            </div>

            {{-- Cross-sell --}}
            @if (isset($crossSellProducts) && $crossSellProducts->isNotEmpty())
                <div class="mt-16">
                    <h2 class="section-title" data-animate="fade-up">{{ __('You may also like') }}</h2>

                    <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4" data-animate="stagger" data-stagger="0.08">
                        @foreach ($crossSellProducts as $crossSellProduct)
                            @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'), ['product' => $crossSellProduct->original_product ?? $crossSellProduct])
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="card p-12">
                @include(EcommerceHelper::viewPath('includes.empty-state'), ['icon' => 'ti ti-shopping-cart'])
            </div>
        @endif
    </div>
</section>
