{{-- Projects Style 4 — Home4 "Case Studies" featured hero card + 2 overlay cards + trusted-by row (matches sec-4-home-4 in index-4.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $rightArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $plusSvg = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>';

    $featured = $projects->first();
    $overlayProjects = $projects->skip(1)->take(2);
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-projects shortcode-projects-style-4 container-2200">
    <div class="sec-4-home-4 pt-100 pb-100 mt-30 rounded-5 mx-lg-3 mx-2 fix p-relative bg-neutral-0">
        {{-- Top header: subtitle + title + primary CTA --}}
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-xxl-5 col-lg-6">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{{ $shortcode->subtitle }}</span>
                                <span class="text-2">{{ $shortcode->subtitle }}</span>
                            </span>
                            <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                        </span>
                    @endif
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
                @if ($shortcode->primary_action_label)
                    <div class="col-lg-3 ms-auto d-flex justify-content-lg-end">
                        <div class="at-btn-group at-btn-group-transparent at_fade_anim" data-delay=".5" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Cards area --}}
        <div class="container pt-70">
            <div class="row g-4">
                {{-- Featured case (full-width) --}}
                @if ($featured)
                    @php
                        // Direct columns take precedence; fall back to meta_boxes so legacy
                        // demo seeds still render until they're migrated to the new fields.
                        // Use null/empty-string check (not ?:) so a literal "0" metric is preserved.
                        $metric1 = ($featured->metric_1_value !== null && $featured->metric_1_value !== '') ? $featured->metric_1_value : $featured->getMetaData('metric_1_value', true);
                        $metric1Label = ($featured->metric_1_label !== null && $featured->metric_1_label !== '') ? $featured->metric_1_label : $featured->getMetaData('metric_1_label', true);
                        $metric2 = ($featured->metric_2_value !== null && $featured->metric_2_value !== '') ? $featured->metric_2_value : $featured->getMetaData('metric_2_value', true);
                        $metric2Label = ($featured->metric_2_label !== null && $featured->metric_2_label !== '') ? $featured->metric_2_label : $featured->getMetaData('metric_2_label', true);
                        $featuredTags = $featured->getMetaData('tags', true);
                        if (is_string($featuredTags)) {
                            $featuredTags = array_filter(array_map('trim', explode(',', $featuredTags)));
                        }
                    @endphp
                    <div class="col-12">
                        <div class="card_case__studies-list">
                            <div class="card_case__studies-card">
                                <div class="card_case__studies-left">
                                    <span class="card_case__studies-featured-tag">{{ __('Featured case') }}</span>
                                    <h4 class="card_case__studies-title">
                                        <a href="{{ $featured->url }}">{!! BaseHelper::clean($featured->name) !!}</a>
                                    </h4>
                                    @if ($featured->description)
                                        <p class="card_case__studies-desc">{{ $featured->description }}</p>
                                    @endif
                                    @if ($metric1 || $metric2)
                                        <div class="card_case__studies-metrics">
                                            @if ($metric1)
                                                <div class="card_case__studies-metric">
                                                    <h4 class="card_case__studies-metric-value">{{ $metric1 }}</h4>
                                                    @if ($metric1Label)
                                                        <span class="card_case__studies-metric-label">{{ $metric1Label }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                            @if ($metric1 && $metric2)
                                                <div class="card_case__studies-metric-divider"></div>
                                            @endif
                                            @if ($metric2)
                                                <div class="card_case__studies-metric">
                                                    <h4 class="card_case__studies-metric-value">{{ $metric2 }}</h4>
                                                    @if ($metric2Label)
                                                        <span class="card_case__studies-metric-label">{{ $metric2Label }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-end justify-content-between mt-auto pt-50">
                                        @if (! empty($featuredTags))
                                            <div class="card_case__studies-tags">
                                                @foreach ($featuredTags as $tag)
                                                    <a href="{{ $featured->url }}" class="card_case__studies-tag">{{ $tag }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <a href="{{ $featured->url }}" class="card_case__studies-link text-white">
                                            <span class="text-white text-nowrap">{{ __('View case') }}</span>
                                            {!! $plusSvg !!}
                                        </a>
                                    </div>
                                </div>
                                <div class="card_case__studies-right">
                                    <div class="card_case__studies-thumb anim-zoomin">
                                        <a href="{{ $featured->url }}">
                                            @if ($featured->image)
                                                <img src="{{ RvMedia::getImageUrl($featured->image) }}" alt="{{ $featured->name }}">
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- 2 overlay case studies --}}
                @foreach ($overlayProjects as $project)
                    @php
                        // Same column-first / meta-fallback pattern as the featured card above.
                        $metricValue = ($project->metric_1_value !== null && $project->metric_1_value !== '') ? $project->metric_1_value : $project->getMetaData('metric_1_value', true);
                        $metricLabel = ($project->metric_1_label !== null && $project->metric_1_label !== '') ? $project->metric_1_label : $project->getMetaData('metric_1_label', true);
                        $tags = $project->getMetaData('tags', true);
                        if (is_string($tags)) {
                            $tags = array_filter(array_map('trim', explode(',', $tags)));
                        }
                    @endphp
                    <div class="card_case__studies-list card_case__studies card_case__studies-list--row col-lg-6">
                        <div class="card_case__studies-card card_case__studies-card--overlay">
                            <div class="card_case__studies-visual">
                                <a href="{{ $project->url }}">
                                    @if ($project->image)
                                        <img src="{{ RvMedia::getImageUrl($project->image) }}" alt="{{ $project->name }}">
                                    @endif
                                </a>
                                @if ($metricValue)
                                    <div class="card_case__studies-metric-overlay">
                                        <h4 class="card_case__studies-metric-value mb-0">{{ $metricValue }}</h4>
                                        @if ($metricLabel)
                                            <span class="card_case__studies-metric-label">{{ $metricLabel }}</span>
                                        @endif
                                    </div>
                                @endif
                                @if (! empty($tags))
                                    <div class="card_case__studies-tags-overlay">
                                        @foreach ($tags as $tag)
                                            <a href="{{ $project->url }}" class="card_case__studies-tag">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="card_case__studies-footer mt-10">
                                <h5 class="card_case__studies-footer-title">
                                    <a href="{{ $project->url }}">{{ $project->name }}</a>
                                </h5>
                                <a href="{{ $project->url }}" class="card_case__studies-link text-white">
                                    <span class="text-white text-nowrap">{{ __('View case') }}</span>
                                    {!! $plusSvg !!}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
