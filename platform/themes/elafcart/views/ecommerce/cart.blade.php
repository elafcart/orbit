@php
    Theme::set('hideBreadcrumb', true);
    $cartInstance = Cart::instance('cart');
    $products = $cartInstance->content();
@endphp

<section class="cart-page section-padding" style="padding-top: 140px;">
    <div class="container">
        <div class="cart-header mb-5">
            <h1 class="section-title">Your Cart</h1>
            <p class="text-muted">{{ $products->count() }} items in your cart</p>
        </div>

        @if($products->isNotEmpty())
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="cart-items">
                        @foreach($products as $item)
                            @php $product = \Botble\Ecommerce\Models\Product::find($item->id); @endphp
                            @continue(!$product)
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <img src="{{ RvMedia::getImageUrl($product->image) }}" alt="{{ $product->name }}">
                                    @if($product->isDigital())
                                        <span class="badge digital"><i class="bi bi-download"></i> Digital</span>
                                    @else
                                        <span class="badge physical"><i class="bi bi-box-seam"></i> Physical</span>
                                    @endif
                                </div>
                                <div class="cart-item-info">
                                    <h5><a href="{{ $product->url }}">{{ $product->name }}</a></h5>
                                    <p class="text-muted small">{{ $product->sku }}</p>
                                    <div class="cart-item-price">
                                        <span class="current">{{ format_price($item->price) }}</span>
                                        @if($product->isDigital())
                                            <span class="digital-note"><i class="bi bi-lightning"></i> Instant Download</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="cart-item-qty">
                                    <form method="POST" action="{{ route('public.cart.update') }}" class="qty-form">
                                        @csrf
                                        <div class="qty-control">
                                            <button type="button" class="qty-btn minus">-</button>
                                            <input type="number" name="items[{{ $item->rowId }}][qty]" value="{{ $item->qty }}" min="1" class="qty-input">
                                            <button type="button" class="qty-btn plus">+</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="cart-item-total">
                                    <strong>{{ format_price($item->price * $item->qty) }}</strong>
                                </div>
                                <div class="cart-item-remove">
                                    <a href="{{ route('public.cart.remove', $item->rowId) }}" class="remove-btn"><i class="bi bi-x-lg"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-actions mt-4 d-flex justify-content-between">
                        <a href="{{ route('public.products') }}" class="btn btn-outline-dark rounded-pill"><i class="bi bi-arrow-left"></i> Continue Shopping</a>
                        <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="document.querySelector('.qty-form').submit()">Update Cart</button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h4>Order Summary</h4>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>{{ format_price(Cart::instance('cart')->rawSubTotal()) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span class="text-success">Calculated at checkout</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>{{ format_price(Cart::instance('cart')->rawTotal()) }}</span>
                        </div>

                        <div class="digital-notice mt-3">
                            <i class="bi bi-info-circle"></i>
                            <p class="small mb-0">Digital products will be available for instant download after payment. Physical products will be shipped.</p>
                        </div>

                        <a href="{{ route('public.checkout.information', OrderHelper::getOrderSessionToken()) }}" class="btn btn-primary btn-lg w-100 rounded-pill mt-4">
                            Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                        <div class="payment-methods mt-4 text-center">
                            <p class="small text-muted mb-2">Secure checkout with</p>
                            <div class="d-flex justify-content-center gap-2">
                                <i class="bi bi-credit-card fs-4"></i>
                                <i class="bi bi-paypal fs-4"></i>
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="bi bi-bag-x" style="font-size: 4rem; color: #d1d5db;"></i>
                </div>
                <h3>Your cart is empty</h3>
                <p class="text-muted mb-4">Looks like you haven't added any products yet</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('public.products') }}?type=digital" class="btn btn-primary rounded-pill"><i class="bi bi-download"></i> Browse Digital Products</a>
                    <a href="{{ route('public.products') }}?type=physical" class="btn btn-outline-dark rounded-pill"><i class="bi bi-box-seam"></i> Browse Physical Products</a>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.cart-item { display: flex; align-items: center; gap: 1.5rem; padding: 1.5rem; background: white; border: 1px solid #f3f4f6; border-radius: 12px; margin-bottom: 1rem; }
.cart-item-image { position: relative; width: 100px; height: 100px; border-radius: 8px; overflow: hidden; flex-shrink: 0; }
.cart-item-image img { width: 100%; height: 100%; object-fit: cover; }
.cart-item-image .badge { position: absolute; bottom: 4px; left: 4px; font-size: 0.6rem; padding: 0.2rem 0.4rem; border-radius: 20px; }
.badge.digital { background: #6366f1; color: white; }
.badge.physical { background: #0f0f0f; color: white; }
.cart-item-info { flex: 1; }
.cart-item-info h5 { font-size: 1rem; margin-bottom: 0.2rem; }
.cart-item-price { display: flex; align-items: center; gap: 0.8rem; margin-top: 0.5rem; }
.digital-note { font-size: 0.75rem; color: #6366f1; background: rgba(99,102,241,0.1); padding: 0.2rem 0.5rem; border-radius: 20px; }
.cart-item-qty .qty-control { display: flex; border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; width: fit-content; }
.qty-btn { width: 36px; height: 36px; border: none; background: #f9fafb; }
.qty-input { width: 50px; height: 36px; border: none; text-align: center; border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; }
.cart-item-total { min-width: 100px; text-align: right; }
.remove-btn { width: 36px; height: 36px; border-radius: 50%; background: #f9fafb; display: flex; align-items: center; justify-content: center; color: #6b7280; }
.remove-btn:hover { background: #ef4444; color: white; }
.cart-summary { background: white; border: 1px solid #f3f4f6; border-radius: 16px; padding: 1.5rem; position: sticky; top: 100px; }
.summary-row { display: flex; justify-content: space-between; padding: 0.8rem 0; border-bottom: 1px solid #f3f4f6; }
.summary-row.total { font-weight: 700; font-size: 1.1rem; border-bottom: none; border-top: 2px solid #0f0f0f; margin-top: 0.5rem; }
.digital-notice { background: rgba(99,102,241,0.05); border: 1px solid rgba(99,102,241,0.1); border-radius: 8px; padding: 1rem; display: flex; gap: 0.5rem; }
.digital-notice i { color: #6366f1; }
</style>
