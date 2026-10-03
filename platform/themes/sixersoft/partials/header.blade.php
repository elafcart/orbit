<header class="site-header">
    <div class="container-shell flex h-16 items-center justify-between gap-4">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2" aria-label="{{ theme_option('site_title', 'Sixersoft') }}">
            @if (theme_option('logo'))
                <img src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title', 'Sixersoft') }}" class="h-8 w-auto">
            @else
                <span class="flex size-8 items-center justify-center rounded-lg bg-brand-600 font-display text-sm font-bold text-white">S</span>
                <span class="font-display text-lg font-bold tracking-tight text-slate-900 dark:text-white">
                    {{ theme_option('site_title', 'Sixersoft') }}
                </span>
            @endif
        </a>

        {{-- Desktop navigation --}}
        <nav class="hidden lg:block" aria-label="{{ __('Main navigation') }}">
            <ul class="flex items-center gap-1">
                {!! Menu::renderMenuLocation('main-menu', ['view' => 'menu']) !!}
            </ul>
        </nav>

        {{-- Right controls --}}
        <div class="flex items-center gap-2">
            @if (is_plugin_active('ecommerce') && EcommerceHelper::isCartEnabled())
                <a
                    href="{{ route('public.cart') }}"
                    aria-label="{{ __('Cart') }}"
                    class="relative flex size-10 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="8" cy="21" r="1" /><circle cx="19" cy="21" r="1" />
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                    </svg>
                    @if (Cart::instance('cart')->count() > 0)
                        <span class="absolute top-1 right-1 flex size-4 items-center justify-center rounded-full bg-brand-600 text-[10px] font-bold text-white">
                            {{ Cart::instance('cart')->count() }}
                        </span>
                    @endif
                </a>
            @endif

            @include(Theme::getThemeNamespace('partials.language-switcher'))

            {{-- Dark mode toggle --}}
            <button
                type="button"
                data-dark-mode-toggle
                aria-label="{{ __('Toggle dark mode') }}"
                class="flex size-10 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <svg class="dark:hidden" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                </svg>
                <svg class="hidden dark:block" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
                </svg>
            </button>

            {{-- Mobile menu toggle --}}
            <button
                id="mobile-menu-toggle"
                type="button"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="{{ __('Toggle menu') }}"
                class="flex size-10 items-center justify-center rounded-full text-slate-700 transition hover:bg-slate-100 lg:hidden dark:text-slate-200 dark:hover:bg-slate-800"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile navigation panel --}}
    <div id="mobile-menu" class="hidden max-h-[calc(100vh-4rem)] overflow-y-auto border-t border-slate-200 bg-white lg:hidden dark:border-slate-800 dark:bg-slate-950">
        <nav class="container-shell py-4" aria-label="{{ __('Mobile navigation') }}">
            <ul class="space-y-1">
                {!! Menu::renderMenuLocation('main-menu', ['view' => 'menu-mobile']) !!}
            </ul>
        </nav>
    </div>
</header>
