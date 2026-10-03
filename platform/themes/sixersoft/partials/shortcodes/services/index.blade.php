@php
    $title = $shortcode->title ?? __('What We Do');
    $subtitle = $shortcode->subtitle ?? __('Services');
    $showFilter = ($shortcode->show_filter ?? true) && $shortcode->show_filter !== 'false';

    $categories = $services->map->category->filter()->unique('id');
@endphp

<section class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-2xl text-center" data-animate="fade-up">
            <span class="section-eyebrow">{{ $subtitle }}</span>
            <h2 class="section-title">{{ $title }}</h2>
        </div>

        @if ($showFilter && $categories->count() > 1)
            <div class="mt-8 flex flex-wrap justify-center gap-2" data-sx-filter data-animate="fade-up">
                <button type="button" data-filter="all" class="sx-filter-btn rounded-full bg-brand-600 px-4 py-2 text-xs font-semibold text-white transition">
                    {{ __('All') }}
                </button>
                @foreach ($categories as $category)
                    <button
                        type="button"
                        data-filter="{{ $category->slug ?? $category->id }}"
                        class="sx-filter-btn rounded-full border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
            @foreach ($services as $service)
                <article
                    class="card card-hover group overflow-hidden"
                    @if ($showFilter && $categories->count() > 1) data-sx-filter-item="{{ $service->category?->slug ?? $service->category?->id ?? 'none' }}" @endif
                >
                    <a href="{{ $service->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                        @if ($service->image)
                            <img
                                src="{{ RvMedia::getImageUrl($service->image, 'medium') }}"
                                alt="{{ $service->name }}"
                                loading="lazy"
                                decoding="async"
                                class="size-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        @endif
                    </a>

                    <div class="p-6">
                        @if ($service->category)
                            <span class="text-xs font-semibold tracking-wide text-brand-600 uppercase dark:text-brand-400">{{ $service->category->name }}</span>
                        @endif

                        <h3 class="mt-1.5 line-clamp-1 text-lg font-semibold">
                            <a href="{{ $service->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $service->name }}</a>
                        </h3>

                        @if ($service->description)
                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed">{{ $service->description }}</p>
                        @endif

                        <a href="{{ $service->url }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400">
                            {{ __('Learn More') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
