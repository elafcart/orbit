{{-- Projects Style 3 — card_case__studies: featured first (is_featured or first item) + overlay grid (portfolio-3.html) --}}
@php
    $viewCaseSvg = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>';
    $arrowSvg    = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';

    // Prefer the is_featured project as the hero card; fall back to the first item
    $featured  = $projects->firstWhere('is_featured', true) ?? $projects->first();
    $remaining = $projects->filter(fn ($p) => $p->id !== optional($featured)->id);
    $titleTag  = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-projects shortcode-projects-style-3 sec-1-portfolio-3 overflow-hidden pt-150 pb-110 border-bottom-100">

    {{-- Section header --}}
    @if($shortcode->title || $shortcode->subtitle)
        <div class="container pb-60">
            <div class="row g-4 align-items-end">
                <div class="col-xxl-8 col-lg-7">
                    @if($shortcode->title)
                        <{{ $titleTag }} class="fz-ds-1 fw-500 {{ $titleSizeClass }}">{{ $shortcode->title }}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->subtitle)
                        <p class="fz-font-lg neutral-900 mb-0">{{ $shortcode->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row align-items-center g-4">

            {{-- Featured card (full-width, left+right split layout) --}}
            @if($featured)
                <div class="col-12">
                    <div class="card_case__studies-list card_case__studies">
                        <div class="card_case__studies-card">
                            <div class="card_case__studies-left">
                                <span class="card_case__studies-featured-tag">{{ __('Featured case') }}</span>
                                <h3 class="h4 card_case__studies-title">
                                    <a href="{{ $featured->url }}">{{ $featured->name }}</a>
                                </h3>
                                @if($featured->description)
                                    <p class="card_case__studies-desc">{{ $featured->description }}</p>
                                @endif
                                {{-- Use place/client as tag-like metadata --}}
                                @if($featured->place || $featured->client)
                                    <div class="card_case__studies-tags">
                                        @if($featured->place)
                                            <span class="card_case__studies-tag">{{ $featured->place }}</span>
                                        @endif
                                        @if($featured->client)
                                            <span class="card_case__studies-tag">{{ $featured->client }}</span>
                                        @endif
                                    </div>
                                @endif
                                <a href="{{ $featured->url }}" class="card_case__studies-link text-white mt-auto d-inline-flex align-items-center gap-2">
                                    <span class="text-white text-nowrap">{{ __('View case') }}</span>
                                    {!! $viewCaseSvg !!}
                                </a>
                            </div>
                            <div class="card_case__studies-right">
                                <div class="card_case__studies-thumb anim-zoomin">
                                    <a href="{{ $featured->url }}">
                                        <img src="{{ RvMedia::getImageUrl($featured->image, null, false, RvMedia::getDefaultImage()) }}"
                                            alt="{{ $featured->name }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Remaining projects — overlay card grid --}}
            @foreach($remaining as $project)
                <div class="card_case__studies-list card_case__studies card_case__studies-list--row col-lg-6">
                    <div class="card_case__studies-card card_case__studies-card--overlay">
                        <div class="card_case__studies-visual">
                            <a href="{{ $project->url }}">
                                <img src="{{ RvMedia::getImageUrl($project->image, null, false, RvMedia::getDefaultImage()) }}"
                                    alt="{{ $project->name }}">
                            </a>
                            @if($project->place || $project->client)
                                <div class="card_case__studies-tags-overlay">
                                    @if($project->place)
                                        <span class="card_case__studies-tag">{{ $project->place }}</span>
                                    @endif
                                    @if($project->client)
                                        <span class="card_case__studies-tag">{{ $project->client }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="card_case__studies-footer mt-10">
                            <h5 class="card_case__studies-footer-title">
                                <a href="{{ $project->url }}">{{ $project->name }}</a>
                            </h5>
                            <a href="{{ $project->url }}" class="card_case__studies-link text-white d-inline-flex align-items-center gap-2">
                                <span class="text-white text-nowrap">{{ __('View case') }}</span>
                                {!! $viewCaseSvg !!}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Primary action button --}}
            @if($shortcode->primary_action_url && $shortcode->primary_action_label)
                <div class="col-12 text-center">
                    <a class="at-btn" href="{{ $shortcode->primary_action_url }}">
                        <span>
                            <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                            <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                        </span>
                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
