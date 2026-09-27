@if (is_plugin_active('ecommerce'))
<div class="at-header-ecommerce d-flex align-items-center gap-2">
    <a href="{{ route('public.cart') }}" class="at-header-cart-btn position-relative" aria-label="{{ __('Cart') }}">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 10a4 4 0 01-8 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        @php $cartCount = Cart::instance('cart')->count(); @endphp
        <span
            class="cart-count badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle {{ $cartCount > 0 ? '' : 'd-none' }}"
            data-bb-value="cart-count"
            aria-label="{{ __(':count items in cart', ['count' => $cartCount]) }}"
        >{{ $cartCount }}</span>
    </a>
</div>
{{-- Core JS only updates the badge text on add-to-cart, never toggles d-none,
     so the badge would stay hidden after the very first item is added.
     Reveal it whenever the count becomes positive. --}}
<script>
    document.addEventListener('ecommerce.cart.added', function () {
        document.querySelectorAll('.at-header-cart-btn .cart-count').forEach(function (el) {
            if ((parseInt(el.textContent, 10) || 0) > 0) {
                el.classList.remove('d-none');
            } else {
                el.classList.add('d-none');
            }
        });
    });
</script>
@endif
