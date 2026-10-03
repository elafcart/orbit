@include(Theme::getThemeNamespace('partials.breadcrumb'))

<article class="section">
    <div class="container-shell">
        <div class="mx-auto max-w-3xl">
            <header data-animate="fade-up">
                @if ($post->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->categories->take(3) as $category)
                            <a href="{{ $category->url }}" class="rounded-full bg-brand-600/10 px-3 py-1 text-xs font-semibold text-brand-600 transition hover:bg-brand-600/20 dark:text-brand-400">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <h1 class="mt-4 font-display text-3xl font-bold tracking-tight text-balance sm:text-5xl">
                    {!! BaseHelper::clean($post->name) !!}
                </h1>

                <div class="mt-6 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-slate-500 dark:text-slate-400">
                    @if ($post->author)
                        <span class="flex items-center gap-2">
                            <span class="flex size-8 items-center justify-center overflow-hidden rounded-full bg-brand-600/10 font-semibold text-brand-600">
                                {{ mb_substr($post->author->name, 0, 1) }}
                            </span>
                            {{ $post->author->name }}
                        </span>
                    @endif
                    <time datetime="{{ $post->created_at->toDateString() }}">{{ Theme::formatDate($post->created_at) }}</time>
                </div>
            </header>
        </div>

        @if ($post->image)
            <div class="mt-10" data-animate="zoom-in">
                <img
                    src="{{ RvMedia::getImageUrl($post->image, 'large') }}"
                    alt="{{ $post->name }}"
                    fetchpriority="high"
                    decoding="async"
                    class="mx-auto max-h-[540px] w-full rounded-2xl object-cover"
                >
            </div>
        @endif

        <div class="mx-auto mt-10 max-w-3xl">
            @if ($post->description)
                <p class="text-xl leading-relaxed text-slate-500 dark:text-slate-400" data-animate="fade-up">
                    {!! BaseHelper::clean($post->description) !!}
                </p>
            @endif

            <div class="entry-content mt-8">
                {!! BaseHelper::clean($post->content) !!}
            </div>

            @if ($post->tags->isNotEmpty())
                <div class="mt-10 flex flex-wrap items-center gap-2 border-t border-slate-200 pt-8 dark:border-slate-800">
                    <span class="mr-1 text-sm font-semibold text-slate-900 dark:text-white">{{ __('Tags') }}:</span>
                    @foreach ($post->tags as $tag)
                        <a href="{{ $tag->url }}" class="rounded-full border border-slate-300 px-3 py-1 text-xs font-medium text-slate-600 transition hover:border-brand-600 hover:text-brand-600 dark:border-slate-700 dark:text-slate-300 dark:hover:border-brand-400 dark:hover:text-brand-400">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mt-8 flex flex-wrap items-center justify-between gap-4">
                {!! Theme::renderSocialSharing($post->url, SeoHelper::getDescription(), $post->image) !!}
            </div>

            {{-- Comments area (rendered by the active comment solution, if any) --}}
            <div class="mt-10">
                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
            </div>
        </div>
    </div>
</article>
