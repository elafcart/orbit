<section class="section">
    <div class="container-shell grid items-center gap-12 lg:grid-cols-2">
        <div data-animate="fade-right">
            <span class="section-eyebrow">{{ $shortcode->subtitle ?? __('About Us') }}</span>
            <h2 class="section-title">{{ $shortcode->title ?? __('Who We Are') }}</h2>

            @if ($shortcode->description)
                <p class="mt-5 leading-relaxed text-slate-600 dark:text-slate-300">{{ $shortcode->description }}</p>
            @endif
        </div>

        @if ($shortcode->image)
            <div data-animate="fade-left">
                <img
                    src="{{ RvMedia::getImageUrl($shortcode->image, 'large') }}"
                    alt="{{ $shortcode->title ?? __('About Us') }}"
                    loading="lazy"
                    decoding="async"
                    class="w-full rounded-2xl object-cover shadow-(--shadow-card)"
                >
            </div>
        @endif
    </div>
</section>
