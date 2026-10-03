<section class="section">
    <div class="container-shell" data-animate="zoom-in">
        <div class="relative overflow-hidden rounded-3xl bg-brand-600 px-8 py-14 text-center sm:px-14">
            <div class="pointer-events-none absolute -top-24 -right-24 size-72 rounded-full bg-white/10 blur-2xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-24 size-72 rounded-full bg-black/10 blur-2xl" aria-hidden="true"></div>

            <h2 class="relative mx-auto max-w-2xl font-display text-3xl font-bold text-balance text-white sm:text-4xl">
                {{ $shortcode->title ?? __('Have an idea? Let’s build it together.') }}
            </h2>

            @if ($shortcode->description)
                <p class="relative mx-auto mt-4 max-w-xl text-white/85">{{ $shortcode->description }}</p>
            @endif

            @if ($shortcode->button_text)
                <a href="{{ $shortcode->button_url ?: url('/contact') }}" class="relative mt-8 inline-flex items-center gap-2 rounded-full bg-white px-7 py-3 text-sm font-semibold text-brand-700 transition hover:opacity-90">
                    {{ $shortcode->button_text }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
</section>
