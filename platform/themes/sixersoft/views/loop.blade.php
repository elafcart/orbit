@php
    // Shared blog archive listing. views/category.blade.php and views/tag.blade.php
    // set $archiveHeading before including this template.
    $archiveHeading ??= theme_option('blog_title', __('Blog'));
@endphp

@include(Theme::getThemeNamespace('partials.breadcrumb'))

<section class="section">
    <div class="container-shell">
        <header class="max-w-2xl" data-animate="fade-up">
            <span class="section-eyebrow">{{ __('Insights & Articles') }}</span>
            <h1 class="section-title">{{ $archiveHeading }}</h1>
        </header>

        @if ($posts->isEmpty())
            <div class="card mt-12 p-12 text-center">
                <p class="text-lg text-slate-500 dark:text-slate-400">{{ __('No posts found.') }}</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-6">{{ __('Back to Home') }}</a>
            </div>
        @else
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-animate="stagger" data-stagger="0.1">
                @foreach ($posts as $post)
                    <article class="card card-hover group overflow-hidden">
                        <a href="{{ $post->url }}" class="block aspect-video overflow-hidden bg-slate-100 dark:bg-slate-800" aria-hidden="true" tabindex="-1">
                            @if ($post->image)
                                <img src="{{ RvMedia::getImageUrl($post->image, 'medium') }}" alt="{{ $post->name }}" class="size-full object-cover transition duration-500 group-hover:scale-105" loading="lazy" decoding="async">
                            @endif
                        </a>

                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-400">
                                @if ($post->categories->isNotEmpty())
                                    <a href="{{ $post->categories->first()->url }}" class="font-semibold text-brand-600 hover:underline dark:text-brand-400">
                                        {{ $post->categories->first()->name }}
                                    </a>
                                @endif
                                <time datetime="{{ $post->created_at->toDateString() }}">{{ Theme::formatDate($post->created_at) }}</time>
                            </div>

                            <h2 class="mt-3 line-clamp-2 text-lg font-semibold leading-snug">
                                <a href="{{ $post->url }}" class="transition group-hover:text-brand-600 dark:group-hover:text-brand-400">{{ $post->name }}</a>
                            </h2>

                            @if ($post->description)
                                <p class="mt-2 line-clamp-3 text-sm leading-relaxed">{{ $post->description }}</p>
                            @endif

                            <a href="{{ $post->url }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 dark:text-brand-400">
                                {{ __('Read More') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
        @endif
    </div>
</section>
