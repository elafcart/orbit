@include(Theme::getThemeNamespace('partials.breadcrumb'))

<article class="section">
    <div class="container-shell">
        @if (! Theme::get('hidePageHeader'))
            <header class="mx-auto max-w-3xl text-center" data-animate="fade-up">
                <h1 class="font-display text-3xl font-bold tracking-tight text-balance sm:text-5xl">{{ $page->name }}</h1>
                @if ($page->description)
                    <p class="mt-4 text-lg text-slate-500 dark:text-slate-400">{{ $page->description }}</p>
                @endif
            </header>
        @endif

        <div class="entry-content mx-auto mt-10 max-w-3xl">
            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, BaseHelper::clean($page->content), $page) !!}
        </div>
    </div>
</article>
