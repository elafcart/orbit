@php
    Theme::set('hideBreadcrumb', true);
    Gallery::registerAssets();
@endphp

<section class="pt-150 pb-80">
    <div class="container">
        @include(Theme::getThemeNamespace('partials.inline-breadcrumb'), [
            'crumbs' => [
                ['url' => route('public.index'), 'label' => __('Home')],
                ['label' => __('Galleries')],
            ],
            'class' => 'mb-4',
        ])

        <h2 class="reveal-text mb-50">{{ __('Galleries') }}</h2>

        @if (isset($galleries) && $galleries->isNotEmpty())
            <div class="row g-4">
                @foreach ($galleries as $gallery)
                    <div class="col-lg-4 col-md-6">
                        <div class="at-project-card rounded-4 overflow-hidden">
                            <div class="anim-zoomin">
                                <a href="{{ $gallery->url }}">
                                    <img
                                        src="{{ RvMedia::getImageUrl($gallery->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        alt="{{ $gallery->name }}"
                                        class="img-cover w-100"
                                    >
                                </a>
                            </div>
                            <div class="at-project-card-content p-3">
                                <h5 class="mb-1">
                                    <a href="{{ $gallery->url }}" class="common-color">{{ $gallery->name }}</a>
                                </h5>
                                @if ($gallery->description)
                                    <p class="fz-font-sm opacity-75 mb-0">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center opacity-50">{{ __('No galleries available.') }}</p>
        @endif
    </div>
</section>
