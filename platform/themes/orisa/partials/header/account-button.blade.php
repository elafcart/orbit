{{-- Account icon: goes to the customer dashboard when signed in, to the login page otherwise. --}}
@if (is_plugin_active('ecommerce'))
    @php
        $isLoggedIn = auth('customer')->check();
        $accountUrl = $isLoggedIn ? route('customer.overview') : route('customer.login');
        $accountLabel = $isLoggedIn ? __('My account') : __('Login');
    @endphp
    <a
        href="{{ $accountUrl }}"
        class="at-header-account-btn"
        aria-label="{{ $accountLabel }}"
        title="{{ $accountLabel }}"
    >
        <svg width="21" height="21" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M8 7a4 4 0 108 0 4 4 0 00-8 0" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5 21v-1a5 5 0 015-5h4a5 5 0 015 5v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
@endif
