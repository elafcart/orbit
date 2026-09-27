@php
    $displayBlogTopSidebar ??= (bool) theme_option('blog_featured_enabled', true);
    $featuredPosts = $displayBlogTopSidebar ? $posts->take(3) : collect();
    $gridPosts = $displayBlogTopSidebar ? $posts->slice(3) : $posts;
    // Paginated archive pages append " - Page N" to the H1 so each pagination URL has a unique heading (SEO).
    $currentPage = method_exists($posts, 'currentPage') ? (int) $posts->currentPage() : 1;
    // Post card titles default to H2 so the archive outline runs H1 -> H2 with no skipped level.
    // The card CSS classes (h4/h5/h6) fix the visual size, so changing this never changes the design.
    $postTitleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag(theme_option('blog_post_title_heading_level'), 'h2');

    // Archive H1. Category and tag views pass their own term name; the blog index leaves it unset
    // and falls back to the theme title; the search view passes an empty string because it renders
    // its own H1 above this listing. Every archive therefore has exactly one H1, on every page of
    // the paginated set, and the search page never gets a second one.
    $isBlogIndex = ! isset($archiveHeading);
    $archiveHeading ??= __('Insights & Articles');
    $showFeaturedHero = $displayBlogTopSidebar && $featuredPosts->isNotEmpty();

    Theme::set('hideBreadcrumb', true);
@endphp

@if($archiveHeading !== '')
    <!-- archive hero section -->
    <div class="sec-1-archive-1 overflow-hidden pt-150">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12">
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{{ __('Blog & Resources') }}</span>
                            <span class="text-2">{{ __('Blog & Resources') }}</span>
                        </span>
                        <i>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"></path>
                            </svg>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"></path>
                            </svg>
                        </i>
                    </span>
                </div>
                <div class="col-12">
                    <h1 class="fz-ds-1 lh-1 fw-500 mb-0">{{ $currentPage > 1 ? __(':title - Page :page', ['title' => $archiveHeading, 'page' => $currentPage]) : $archiveHeading }}</h1>
                    @if($isBlogIndex && theme_option('blog_description'))
                        <h2 class="h6 fw-500 fz-font-lg mb-0 mt-20">{{ theme_option('blog_description') }}</h2>
                    @endif
                </div>
            </div>
            @if($showFeaturedHero)
            <div class="row g-4 pt-70">
                @foreach($featuredPosts as $index => $post)
                    <div class="col-lg-4 col-12">
                        @if($index === 0)
                            <div class="alt-portfolio-item mb-30 at-hover-item">
                                <a href="{{ $post->url }}" class="alt-portfolio-thumb mb-15 rounded-0 p-relative fix d-block">
                                    {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'w-100 scale-img-from-to', 'data-value-1' => '1.5', 'data-value-2' => '1']) }}
                                    <div class="alt-portfolio-btn start-0 end-0 mx-4">
                                        <div class="content">
                                            @if($post->categories->isNotEmpty())
                                                <span class="bg-transparent text-uppercase border px-3 py-1 rounded-pill text-white fz-font-label">{{ $post->categories->first()->name }}</span>
                                            @endif
                                            @if($post->name)
                                                <{{ $postTitleTag }} class="h4 fw-600 text-white mb-0 mt-20">{!! BaseHelper::clean($post->name) !!}</{{ $postTitleTag }}>
                                            @endif
                                            @if($post->description)
                                                <p class="text-white fz-font-lg mb-0 mt-10 text-truncate-3 des">{{ $post->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div>
                                <div class="blog-card__thumb hover-effect-1">
                                    <a href="{{ $post->url }}" class="blog-card__img-link">
                                        <span class="anim-zoomin">
                                            {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'blog-card__img']) }}
                                        </span>
                                    </a>
                                </div>
                                <div class="blog-card__content mt-30">
                                    @if($post->name)
                                        <{{ $postTitleTag }} class="h5 blog-card__title">
                                            <a href="{{ $post->url }}" class="blog-card__title-link">{!! BaseHelper::clean($post->name) !!}</a>
                                        </{{ $postTitleTag }}>
                                    @endif
                                    <p class="blog-card__meta">
                                        <span class="blog-card__meta-text">{{ __('By') }} </span>
                                        @if($post->author)
                                            <span class="blog-card__author">{{ $post->author->name }}</span>
                                        @endif
                                        <span class="blog-card__meta-text"> &ndash; {{ Theme::formatDate($post->created_at) }}</span>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
@endif

<!-- blog grid section -->
<div class="sec-2-archive-1 overflow-hidden pt-100 pb-100">
    <div class="container">
        @if($displayBlogTopSidebar)
            <div class="row align-items-center">
                <div class="col-lg-2 mb-lg-0 mb-3">
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{{ __('Latest News') }}</span>
                            <span class="text-2">{{ __('Latest News') }}</span>
                        </span>
                        <i>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"></path>
                            </svg>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"></path>
                            </svg>
                        </i>
                    </span>
                </div>
                @php
                    $categories = \Botble\Blog\Models\Category::query()
                        ->wherePublished()
                        ->limit(5)
                        ->get();
                @endphp
                @if($categories->isNotEmpty())
                    <div class="col-lg-8 ms-auto">
                        <div class="filter-portfolio d-flex flex-wrap align-items-center justify-content-lg-end gap-2">
                            @foreach($categories as $category)
                                <a href="{{ $category->url }}" class="at-btn filter-btn btn-sm">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="col-12 pb-50"></div>
            </div>
        @endif

        <div class="row">
            @forelse($gridPosts as $post)
                <div class="blog-card col-lg-3 col-md-6 col-12 mb-30">
                    <div class="blog-card__thumb hover-effect-1">
                        <a href="{{ $post->url }}" class="blog-card__img-link">
                            {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'blog-card__img22']) }}
                        </a>
                    </div>
                    <div class="blog-card__content">
                        @if($post->name)
                            <{{ $postTitleTag }} class="h6 blog-card__title">
                                <a href="{{ $post->url }}" class="blog-card__title-link">{!! BaseHelper::clean($post->name) !!}</a>
                            </{{ $postTitleTag }}>
                        @endif
                        <p class="blog-card__meta">
                            <span class="blog-card__meta-text">{{ __('By') }} </span>
                            @if($post->author)
                                <span class="blog-card__author">{{ $post->author->name }}</span>
                            @endif
                            <span class="blog-card__meta-text"> &ndash; {{ Theme::formatDate($post->created_at) }}</span>
                        </p>
                    </div>
                </div>
            @empty
                @if(!$displayBlogTopSidebar || $featuredPosts->isEmpty())
                    <div class="col-12 text-center py-5">
                        <p class="fz-font-lg">{{ __('No posts found.') }}</p>
                    </div>
                @endif
            @endforelse

            @if($posts->isNotEmpty())
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center col-lg-6 col-md-8 mx-auto">
                        {!! $posts->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
