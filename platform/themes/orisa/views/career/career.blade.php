@php
    Theme::set('hideBreadcrumb', true);
    $applyUrl = $career->getMetaData('apply_url', true);
    $tags = collect(json_decode($career->getMetaData('tags', true), true))->pluck('value');
@endphp

<section class="pt-150 pb-80">
    <div class="container">
        @include(Theme::getThemeNamespace('partials.inline-breadcrumb'), [
            'crumbs' => [
                ['url' => route('public.index'), 'label' => __('Home')],
                ['url' => route('public.careers'), 'label' => __('Careers')],
                ['label' => $career->name],
            ],
            'class' => 'mb-4',
        ])

        @if ($image = $career->getMetaData('image', true))
            <div class="rounded-4 overflow-hidden mb-4 anim-zoomin">
                <img
                    src="{{ RvMedia::getImageUrl($image) }}"
                    alt="{{ $career->name }}"
                    class="w-100"
                >
            </div>
        @endif

        <div class="row align-items-center mb-4">
            <div class="col-lg-8 col-md-8">
                <h2 class="mb-2">{!! BaseHelper::clean($career->name) !!}</h2>
                <div class="d-flex flex-wrap gap-3 fz-font-sm opacity-75">
                    <span class="d-inline-flex align-items-center gap-1">{!! BaseHelper::renderIcon('ti ti-calendar') !!} {{ $career->created_at->translatedFormat('d M Y') }}</span>
                    <span class="d-inline-flex align-items-center gap-1">{!! BaseHelper::renderIcon('ti ti-eye') !!} {{ number_format($career->views) }} {{ __('views') }}</span>
                </div>
            </div>
            @if ($applyUrl)
                <div class="col-lg-4 col-md-4 text-start text-md-end mt-3 mt-md-0">
                    <a class="at-btn common-white" href="{{ $applyUrl }}">
                        <span>{{ __('Apply Now') }}</span>
                    </a>
                </div>
            @endif
        </div>

        <div class="border-bottom mb-4"></div>

        @if ($career->salary || $career->location)
            <div class="row g-3 mb-4">
                @if ($career->salary)
                    <div class="col-md-6">
                        <div class="at-service-card rounded-4 p-3">
                            <span class="fw-bold">{{ __('Salary') }}</span>
                            <p class="mb-0 mt-1">{{ $career->salary }}</p>
                        </div>
                    </div>
                @endif
                @if ($career->location)
                    <div class="col-md-6">
                        <div class="at-service-card rounded-4 p-3">
                            <span class="fw-bold">{{ __('Location') }}</span>
                            <p class="mb-0 mt-1">{{ $career->location }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="ck-content">
            {!! BaseHelper::clean($career->content) !!}
        </div>

        <div class="d-flex flex-wrap align-items-center gap-3 mt-5 pt-3 border-top">
            @if ($applyUrl)
                <a class="at-btn common-white" href="{{ $applyUrl }}">
                    <span>{{ __('Apply Now') }}</span>
                </a>
            @endif
            @if ($tags->isNotEmpty())
                <div class="d-flex flex-wrap gap-2 ms-auto">
                    @foreach ($tags as $tag)
                        <span class="badge bg-secondary bg-opacity-10 common-color fz-font-sm px-3 py-2 rounded-pill">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

@if ($relatedCareers->isNotEmpty())
    <section class="pb-80">
        <div class="container">
            <h3 class="mb-4">{{ __('More Job Openings') }}</h3>
            <div class="row g-4">
                @foreach ($relatedCareers as $relatedCareer)
                    <div class="col-lg-4 col-md-6">
                        <div class="at-service-card rounded-4 p-4 h-100 d-flex flex-column">
                            <h5 class="mb-2">
                                <a href="{{ $relatedCareer->url }}" class="common-color">{{ $relatedCareer->name }}</a>
                            </h5>
                            @if ($relatedCareer->description)
                                <p class="fz-font-sm opacity-75 mb-3">{{ Str::limit($relatedCareer->description, 100) }}</p>
                            @endif
                            <div class="mt-auto">
                                <a class="at-btn common-black bg-transparent p-0" href="{{ $relatedCareer->url }}">
                                    <span>{{ __('Learn More') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
