<footer class="border-t border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900/40">
    <div class="container-shell section">
        <div class="grid gap-10 md:grid-cols-3">
            {{-- Brand --}}
            <div>
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <span class="flex size-8 items-center justify-center rounded-lg bg-brand-600 font-display text-sm font-bold text-white">S</span>
                    <span class="font-display text-lg font-bold text-slate-900 dark:text-white">
                        {{ theme_option('site_title', 'Sixersoft') }}
                    </span>
                </a>
                <p class="mt-4 max-w-xs text-sm leading-relaxed">
                    {{ theme_option('site_description', __('Sixersoft — a basic Botble CMS theme built with Tailwind CSS, GSAP and Vite.')) }}
                </p>
            </div>

            {{-- Quick links --}}
            <div>
                <h3 class="text-sm font-semibold tracking-wider text-slate-900 uppercase dark:text-white">{{ __('Quick Links') }}</h3>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="transition hover:text-brand-600 dark:hover:text-brand-400">{{ __('Home') }}</a></li>
                    @if (is_plugin_active('blog'))
                        <li><a href="{{ url('/blog') }}" class="transition hover:text-brand-600 dark:hover:text-brand-400">{{ __('Blog') }}</a></li>
                    @endif
                    @if (is_plugin_active('contact'))
                        <li><a href="{{ url('/contact') }}" class="transition hover:text-brand-600 dark:hover:text-brand-400">{{ __('Contact') }}</a></li>
                    @endif
                </ul>
            </div>

            {{-- Language --}}
            <div>
                <h3 class="text-sm font-semibold tracking-wider text-slate-900 uppercase dark:text-white">{{ __('Language') }}</h3>
                <div class="mt-4">
                    @include(Theme::getThemeNamespace('partials.language-switcher'), ['asLinks' => true])
                </div>
            </div>
        </div>

        <div class="mt-12 border-t border-slate-200 pt-6 text-center text-sm dark:border-slate-800">
            @if (theme_option('copyright'))
                <p>{!! BaseHelper::clean(theme_option('copyright')) !!}</p>
            @else
                <p>&copy; {{ now()->format('Y') }} {{ theme_option('site_title', 'Sixersoft') }}. {{ __('All rights reserved.') }}</p>
            @endif
            <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">
                {{ __('Powered by') }} <a href="https://botble.com" target="_blank" rel="noopener" class="underline hover:text-brand-600">Botble CMS</a>
                · {{ __('Theme') }} Sixersoft
            </p>
        </div>
    </div>
</footer>
