@php Theme::set('hideBreadcrumb', true); @endphp

{!! apply_filters('ads_render', null, 'post_before', ['class' => 'my-2 text-center']) !!}

<!-- blog-details section 1 -->
<div class="sec-1-blog-details overflow-hidden pt-150 pb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto">
                @include(Theme::getThemeNamespace('partials.inline-breadcrumb'), [
                    'crumbs' => array_filter([
                        ['url' => route('public.index'), 'label' => __('Blog')],
                        $post->categories->isNotEmpty() ? ['label' => $post->categories->first()->name] : null,
                    ]),
                ])
                <h1 class="fw-600 lh-1 mb-0">{!! BaseHelper::clean($post->name) !!}</h1>
                <div class="d-flex flex-column flex-md-row align-items-md-end gap-2 justify-content-between pt-30">
                    <div class="d-flex align-items-center gap-2">
                        @if($post->author)
                            <div class="size-56 rounded-circle overflow-hidden">
                                {{ RvMedia::image($post->author->avatar_url, $post->author->name, attributes: ['class' => 'img-cover']) }}
                            </div>
                            <div>
                                <p class="h6 mb-0">{{ $post->author->name }}</p>
                                <span class="nav-menu__item fz-font-sm neutral-500">{{ Theme::formatDate($post->created_at) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex align-items-center gap-4">
                        <span class="nav-menu__item fz-font-label fw-600 neutral-500 text-uppercase">{{ __('Share this article') }}</span>
                        {!! Theme::renderSocialSharing($post->url, SeoHelper::getDescription(), $post->image) !!}
                    </div>
                </div>
            </div>
            <div class="col-12 py-5">
                {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'img-fluid w-100']) }}
            </div>
            <div class="col-lg-8 mx-auto">
                <div class="content">
                    @if($post->description)
                        <p class="h6 fz-font-2xl fw-400 mb-60">{!! BaseHelper::clean($post->description) !!}</p>
                    @endif

                    <div class="ck-content">
                        {!! BaseHelper::clean($post->content) !!}
                    </div>

                    @if ($post->tags->isNotEmpty())
                        <div class="border-top-100 py-5">
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">
                                @foreach($post->tags as $tag)
                                    <a href="{{ $tag->url }}" class="at-btn filter-btn btn-sm">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $post) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $relatedPosts = get_related_posts($post->getKey(), 4);
@endphp

@if($relatedPosts->isNotEmpty())
    <!-- blog-details section 2 -->
    <div class="sec-2-blog-details overflow-hidden pt-100 pb-100 bg-neutral-50">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
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
            </div>
            <div class="row pt-20">
                @foreach($relatedPosts as $post)
                    <div class="blog-card col-lg-3 col-md-6 col-12 mb-30">
                        <div class="blog-card__thumb hover-effect-1">
                            <a href="{{ $post->url }}" class="blog-card__img-link">
                                {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'blog-card__img22']) }}
                            </a>
                        </div>
                        <div class="blog-card__content">
                            <h2 class="h6 blog-card__title">
                                <a href="{{ $post->url }}" class="blog-card__title-link">{!! BaseHelper::clean($post->name) !!}</a>
                            </h2>
                            <p class="blog-card__meta">
                                <span class="blog-card__meta-text">{{ __('By') }} </span>
                                @if($post->author)
                                    <span class="blog-card__author">{{ $post->author->name }}</span>
                                @endif
                                <span class="blog-card__meta-text"> &ndash; {{ Theme::formatDate($post->created_at) }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

{!! apply_filters('ads_render', null, 'post_after', ['class' => 'my-2 text-center']) !!}
