@php
    Theme::set('hideBreadcrumb', true);
    $cartInstance = Cart::instance('cart');
    $cartItems    = $cartInstance->content();
    $hasItems     = $cartItems->isNotEmpty();
    $subtotal     = $cartInstance->rawSubTotal();
    $tax          = EcommerceHelper::isTaxEnabled() ? $cartInstance->rawTax() : 0;
    $total        = $cartInstance->rawTotal();
    $appliedCoupon = session('applied_coupon_code');
    $couponDiscount = $couponDiscountAmount ?? 0;
    $promotionDiscount = $promotionDiscountAmount ?? 0;
    $grandTotal   = ($promotionDiscount + $couponDiscount) > $total
        ? 0
        : ($total - $promotionDiscount - $couponDiscount);
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 0 9.9375 0L3.1875 0C2.77329 0 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
@endphp

{{-- Page hero --}}
<div class="sec-1-shop-archive-1 overflow-hidden pt-150" data-bb-toggle="cart-content">
    <div class="container pb-20">
        <div class="row align-items-end">
            <div class="col-lg-3 col-md-6">
                <h2 class="lh-1 fw-600 mb-md-0 mb-4">{{ __('Your Cart') }}</h2>
            </div>
            <div class="col-lg-3 col-md-6 ms-auto text-md-end">
                <a href="{{ route('public.products') }}" class="border-bottom-900 d-inline-block">
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{{ __('Continue shopping') }}</span>
                            <span class="text-2">{{ __('Continue shopping') }}</span>
                        </span>
                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                    </span>
                </a>
            </div>
            <div class="col-12">
                <div class="border-bottom-100 pb-40 mb-60"></div>
            </div>
        </div>

        @if ($hasItems)
            <div class="row g-4">
                {{-- Cart items column --}}
                <div class="col-lg-8">
                    <x-core::form method="POST" :url="route('public.cart.update')" class="mw-100">
                    <div class="cart-list">
                        <div class="cart-list__items">
                            @foreach ($cartItems as $key => $item)
                                @php $product = $products->find($item->id); @endphp
                                @continue(empty($product))

                                <input type="hidden" name="items[{{ $key }}][rowId]" value="{{ $item->rowId }}">
                                <article class="cart-item" data-cart-row="{{ $item->rowId }}">
                                    <div class="cart-item__inner d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="cart-item__left d-flex align-items-center gap-3">
                                            <div class="cart-item__main d-flex align-items-center gap-3">
                                                <div class="cart-item__img-wrap">
                                                    <a href="{{ $product->original_product->url }}">
                                                        {{ RvMedia::image($item->options['image'] ?? null, $product->original_product->name, 'thumb', attributes: ['class' => 'cart-item__img']) }}
                                                    </a>
                                                </div>
                                                <div class="cart-item__info">
                                                    <h3 class="cart-item__title">
                                                        <a href="{{ $product->original_product->url }}">{{ $product->original_product->name }}</a>
                                                    </h3>
                                                    @if (!empty($item->options['attributes']))
                                                        <p class="cart-item__meta">{{ $item->options['attributes'] }}</p>
                                                    @endif
                                                    <p class="cart-item__price" data-bb-value="cart-product-price-text">
                                                        {{ format_price($item->price) }}
                                                    </p>
                                                    @if ($product->isOutOfStock())
                                                        <span class="small text-danger">{{ trans('plugins/ecommerce::ecommerce.out_of_stock') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart-item__right d-flex align-items-center justify-content-between gap-3">
                                            <div class="cart-item__qty" data-bb-value="cart-product-quantity" data-bb-toggle="product-quantity">
                                                <input type="hidden" name="items[{{ $key }}][rowId]" value="{{ $item->rowId }}">                                                
                                                <button class="cart-item-qty-minus" data-bb-toggle="product-quantity-toggle" data-value="minus" type="button" aria-label="{{ trans('plugins/ecommerce::ecommerce.minus') }}">−</button>
                                                <input
                                                    class="cart-item-qty-val"
                                                    data-bb-toggle="input"
                                                    type="number"
                                                    name="items[{{ $key }}][values][qty]"
                                                    value="{{ $item->qty }}"
                                                    min="1"
                                                    max="{{ $product->with_storehouse_management ? $product->quantity : 1000 }}"
                                                    title="{{ trans('plugins/ecommerce::products.quantity') }}"
                                                />
                                                <button class="cart-item-qty-plus" data-bb-toggle="product-quantity-toggle" data-value="plus" type="button" aria-label="{{ trans('plugins/ecommerce::ecommerce.plus') }}">+</button>
                                            </div>
                                            <a
                                                href="{{ route('public.cart.remove', $item->rowId) }}"
                                                class="cart-item-delete"
                                                aria-label="{{ __('Remove item') }}"
                                                title="{{ __('Remove item') }}"
                                                data-bb-toggle="remove-from-cart"
                                                {!! EcommerceHelper::jsAttributes('remove-from-cart', $product, ['data-product-quantity' => $item->qty]) !!}
                                            >
                                                {!! BaseHelper::renderIcon('ti ti-trash') !!}
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    </x-core::form>
                </div>

                {{-- Summary sidebar --}}
                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3 class="cart-summary__title">{{ __('Summary') }}</h3>

                        {{-- Coupon --}}
                        <x-core::form
                            :url="route('public.coupon.apply')"
                            method="post"
                            data-bb-toggle="coupon-form"
                            id="coupon-form"
                            class="cart-summary__coupon d-flex align-items-center gap-2 flex-wrap mb-3"
                        >
                            <input
                                type="text"
                                class="cart-summary__coupon-input"
                                name="coupon_code"
                                placeholder="{{ __('Enter Your Coupon') }}"
                                aria-label="{{ __('Coupon code') }}"
                                value="{{ BaseHelper::stringify(old('coupon_code', $appliedCoupon)) }}"
                            >
                            <button
                                class="at-btn cart-summary__coupon-btn"
                                type="submit"
                                data-bb-toggle="coupon-form-btn"
                                @disabled($appliedCoupon)
                            >
                                <span>
                                    <span class="text-1">{{ __('Apply') }}</span>
                                    <span class="text-2">{{ __('Apply') }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </button>
                        </x-core::form>

                        @if ($appliedCoupon && $couponDiscount > 0)
                            <div class="cart-summary__coupon-applied d-flex align-items-center justify-content-between mb-2 small">
                                <span>{{ __('Coupon') }}: <strong>{{ $appliedCoupon }}</strong></span>
                                <a class="text-danger" data-bb-toggle="remove-coupon" href="{{ route('public.coupon.remove') }}">{{ trans('plugins/ecommerce::ecommerce.remove') }}</a>
                            </div>
                        @endif

                        <div class="cart-summary__divider" aria-hidden="true"></div>

                        <div class="cart-summary__rows">
                            <div class="cart-summary__row d-flex justify-content-between align-items-center">
                                <span class="cart-summary__label">{{ __('Sub total') }}</span>
                                <span class="cart-summary__value cart-summary__subtotal" data-bb-value="cart-subtotal">{{ format_price($subtotal) }}</span>
                            </div>

                            @if ($couponDiscount > 0)
                                <div class="cart-summary__row d-flex justify-content-between align-items-center">
                                    <span class="cart-summary__label">{{ __('Discount') }}</span>
                                    <span class="cart-summary__value cart-summary__discount" data-bb-value="cart-coupon-discount-amount">-{{ format_price($couponDiscount) }}</span>
                                </div>
                            @endif

                            @if ($promotionDiscount > 0)
                                <div class="cart-summary__row d-flex justify-content-between align-items-center">
                                    <span class="cart-summary__label">{{ trans('plugins/ecommerce::ecommerce.promotion') }}</span>
                                    <span class="cart-summary__value" data-bb-value="cart-promotion-discount-amount">-{{ format_price($promotionDiscount) }}</span>
                                </div>
                            @endif

                            @if (EcommerceHelper::isTaxEnabled())
                                <div class="cart-summary__row d-flex justify-content-between align-items-center">
                                    <span class="cart-summary__label">{{ __('Tax') }}</span>
                                    <span class="cart-summary__value cart-summary__tax" data-bb-value="cart-tax">{{ format_price($tax) }}</span>
                                </div>
                            @endif

                            <div class="cart-summary__row d-flex justify-content-between align-items-center">
                                <span class="cart-summary__label fw-bold">{{ __('Total') }}</span>
                                <span class="cart-summary__value cart-summary__total fw-bold" data-bb-value="cart-total">{{ format_price($grandTotal) }}</span>
                            </div>
                        </div>

                        <a
                            href="{{ route('public.checkout.information', OrderHelper::getOrderSessionToken()) }}"
                            data-bb-toggle="cart-checkout"
                            class="at-btn cart-summary__checkout-btn w-100 mt-4"
                        >
                            <span>
                                <span class="text-1">{{ __('Proceed to Checkout') }}</span>
                                <span class="text-2">{{ __('Proceed to Checkout') }}</span>
                            </span>
                            <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                        </a>

                        <p class="cart-summary__delivery text-center mt-3">
                            <small>{{ trans('plugins/ecommerce::order.shipping_fees_not_included') }}</small>
                        </p>
                    </div>
                </div>
            </div>

        @else
            {{-- Empty cart state --}}
            <div class="row justify-content-center text-center py-80">
                <div class="col-lg-6">
                    <p class="fz-font-lg neutral-500 mb-4">{{ __('Your cart is empty.') }}</p>
                    <a href="{{ route('public.products') }}" class="at-btn">
                        <span>
                            <span class="text-1">{{ __('Continue Shopping') }}</span>
                            <span class="text-2">{{ __('Continue Shopping') }}</span>
                        </span>
                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Cart-row removal hook.
     Core ecommerce JS removes the deleted item via `closest('tr')`, but this
     theme renders cart items as <article class="cart-item"> rows instead of
     a table — so the deleted row never disappears and totals stay stale.
     Listen to `ecommerce.cart.removed` and replace the whole cart-content
     block with the freshly-rendered HTML returned by the server, which keeps
     row visibility, summary totals, and tax/discount lines in sync. --}}
<script>

    document.addEventListener('ecommerce.cart.removed', function (event) {
        if (!window.jQuery) {
            return;
        }

        var data = event.detail && event.detail.data ? event.detail.data : null;

        if (data && data.cart_content) {
            var $cart = window.jQuery('[data-bb-toggle="cart-content"]');
            if ($cart.length) {
                $cart.replaceWith(data.cart_content);
                return;
            }
        }

        var trigger = event.detail && event.detail.element ? event.detail.element : null;
        if (!trigger) {
            return;
        }

        var $el = trigger.jquery ? trigger : window.jQuery(trigger);
        var $row = $el.closest('[data-cart-row]');
        if ($row.length) {
            $row.remove();
        }
    });

    // Coupon apply/remove on the cart page.
    // Core ecommerce JS posts the coupon and only shows a toast - it refreshes
    // totals on the checkout page only. On the cart page the summary is rendered
    // server-side, so the discount never appeared and the coupon looked broken.
    // Reload once the coupon is stored so the summary re-renders with it.
    document.addEventListener('ecommerce.coupon.applied', function () {
        window.location.reload();
    });

    // The remove link points at a POST-only route, so following it as a plain
    // link returns 405. Submit it as a real POST instead, reusing the CSRF token
    // from the coupon form - the frontend layout has no csrf-token meta tag.
    // The controller redirects back, so the summary re-renders without the coupon.
    document.addEventListener('click', function (event) {
        var trigger = event.target && event.target.closest
            ? event.target.closest('[data-bb-toggle="remove-coupon"]')
            : null;

        if (!trigger) {
            return;
        }

        event.preventDefault();

        var tokenInput = document.querySelector('#coupon-form input[name="_token"]');
        var tokenMeta = document.querySelector('meta[name="csrf-token"]');

        var form = document.createElement('form');
        form.method = 'POST';
        form.action = trigger.getAttribute('href');
        form.style.display = 'none';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_token';
        input.value = tokenInput ? tokenInput.value : (tokenMeta ? tokenMeta.getAttribute('content') : '');
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    });
</script>
