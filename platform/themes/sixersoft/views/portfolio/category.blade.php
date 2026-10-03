@php
    $categoryServices = $category->services()->wherePublished()->oldest('order')->latest()->paginate(9);
@endphp

@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section class="section">
    <div class="container-shell">
        <header class="max-w-2xl" data-animate="fade-up">
            <span class="section-eyebrow">{{ __('Services') }}</span>
            <h1 class="section-title">{{ $category->name }}</h1>
            @if ($category->description)
                <p class="mt-3 text-slate-500 dark:text-slate-400">{{ $category->description }}</p>
            @endif
        </header>

        @if ($categoryServices->isEmpty())
            <div class="card mt-12 p-12 text-center">
                <p class="text-lg text-slate-500 dark:text-slate-400">{{ __('No services found in this category.') }}</p>
            </div>
        @else
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
                @foreach ($categoryServices as $service)
                    <article class="card card-hover group overflow-hidden">
                        <a href="{{ $service->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                            @if ($service->image)
                                <img src="{{ RvMedia::getImageUrl($service->image, 'medium') }}" alt="{{ $service->name }}" loading="lazy" decoding="async" class="size-full object-cover transition duration-500 group-hover:scale-105">
                            @endif
                        </a>
                        <div class="p-6">
                            <h2 class="line-clamp-1 text-lg font-semibold">
                                <a href="{{ $service->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $service->name }}</a>
                            </h2>
                            @if ($service->description)
                                <p class="mt-2 line-clamp-2 text-sm leading-relaxed">{{ $service->description }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            {!! $categoryServices->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
        @endif
    </div>
</section>
