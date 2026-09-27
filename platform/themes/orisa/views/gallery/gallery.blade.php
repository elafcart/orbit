@php
    Theme::set('hideBreadcrumb', true);
    Gallery::registerAssets();
    $images = gallery_meta_data($gallery);
@endphp

<section class="pt-150 pb-80">
    <div class="container">
        @include(Theme::getThemeNamespace('partials.inline-breadcrumb'), [
            'crumbs' => [
                ['url' => route('public.index'), 'label' => __('Home')],
                ['url' => Gallery::getGalleriesPageUrl(), 'label' => __('Galleries')],
                ['label' => $gallery->name],
            ],
            'class' => 'mb-4',
        ])

        <h2 class="reveal-text mb-3">{!! BaseHelper::clean($gallery->name) !!}</h2>

        @if ($gallery->description)
            <div class="ck-content mb-4">
                {!! BaseHelper::clean($gallery->description) !!}
            </div>
        @endif

        @if ($images)
            <div id="list-photo" class="row g-3">
                @foreach ($images as $image)
                    @continue(!$image)
                    @php
                        $imageUrl = Arr::get($image, 'img');
                        $description = BaseHelper::clean(Arr::get($image, 'description'));
                    @endphp
                    <div
                        class="col-lg-4 col-md-6 item"
                        data-src="{{ RvMedia::getImageUrl($imageUrl) }}"
                        data-sub-html="{{ $description }}"
                    >
                        <div class="at-project-card rounded-4 overflow-hidden">
                            <div class="anim-zoomin">
                                <a href="{{ RvMedia::getImageUrl($imageUrl) }}">
                                    <img
                                        src="{{ RvMedia::getImageUrl($imageUrl, 'medium') }}"
                                        alt="{{ $description }}"
                                        class="img-cover w-100"
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex align-items-center mt-5 py-3 border-top">
            <span class="fw-bold me-2">{{ __('Share:') }}</span>
            {!! Theme::renderSocialSharing($gallery->url, SeoHelper::getDescription(), $gallery->image) !!}
        </div>

        {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $gallery) !!}
    </div>
</section>
