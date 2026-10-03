@php
    $title = $shortcode->title ?? __('Latest Articles');
    $subtitle = $shortcode->subtitle ?? __('From the blog');
@endphp

<section class="section">
    <div class="container-shell">
        <div class="flex flex-wrap items-end justify-between gap-4" data-animate="fade-up">
            <div>
                <span class="section-eyebrow">{{ $subtitle }}</span>
                <h2 class="section-title">{{ $title }}</h2>
            </div>
            <a href="{{ url('/blog') }}" class="btn btn-outline">{{ __('View All') }}</a>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3" data-animate="stagger" data-stagger="0.1">
            @foreach ($posts as $post)
                <article class="card card-hover group overflow-hidden">
                    <a href="{{ $post->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                        @if ($post->image)
                            <img src="{{ RvMedia::getImageUrl($post->image, 'medium') }}" alt="{{ $post->name }}" loading="lazy" decoding="async" class="size-full object-cover transition duration-500 group-hover:scale-105">
                        @endif
                    </a>
                    <div class="p-6">
                        <p class="text-xs font-medium text-slate-400">{{ Theme::formatDate($post->created_at) }}</p>
                        <h3 class="mt-2 line-clamp-2 text-lg font-semibold leading-snug">
                            <a href="{{ $post->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $post->name }}</a>
                        </h3>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
