@include(Theme::getThemeNamespace('partials.breadcrumb'))

<article class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-3xl">
            <header data-animate="fade-up">
                @if ($service->category)
                    <a href="{{ $service->category->url }}" class="rounded-full bg-brand-600/10 px-3 py-1 text-xs font-semibold text-brand-600 transition hover:bg-brand-600/20 dark:text-brand-400">
                        {{ $service->category->name }}
                    </a>
                @endif

                <h1 class="mt-4 font-display text-3xl font-bold tracking-tight text-balance sm:text-5xl">
                    {{ $service->name }}
                </h1>

                @if ($service->description)
                    <p class="mt-4 text-lg text-slate-500 dark:text-slate-400">{{ $service->description }}</p>
                @endif
            </header>
        </div>

        @if ($service->image)
            <div class="mt-10" data-animate="zoom-in">
                <img
                    src="{{ RvMedia::getImageUrl($service->image, 'large') }}"
                    alt="{{ $service->name }}"
                    fetchpriority="high"
                    decoding="async"
                    class="mx-auto max-h-[540px] w-full rounded-2xl object-cover"
                >
            </div>
        @endif

        <div class="entry-content mx-auto mt-10 max-w-3xl">
            {!! BaseHelper::clean($service->content) !!}
        </div>

        @if ($relatedServices->isNotEmpty())
            <div class="mt-16">
                <h2 class="section-title" data-animate="fade-up">{{ __('Related Services') }}</h2>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
                    @foreach ($relatedServices as $relatedService)
                        <article class="card card-hover group overflow-hidden">
                            <a href="{{ $relatedService->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                                @if ($relatedService->image)
                                    <img src="{{ RvMedia::getImageUrl($relatedService->image, 'medium') }}" alt="{{ $relatedService->name }}" loading="lazy" decoding="async" class="size-full object-cover transition duration-500 group-hover:scale-105">
                                @endif
                            </a>
                            <div class="p-6">
                                <h3 class="line-clamp-1 text-lg font-semibold">
                                    <a href="{{ $relatedService->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $relatedService->name }}</a>
                                </h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</article>
