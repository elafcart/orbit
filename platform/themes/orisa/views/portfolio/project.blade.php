@php
    Theme::set('hideBreadcrumb', true);
    $projectImages = array_values(array_unique(array_filter(array_merge(
        $project->image ? [$project->image] : [],
        is_array($project->images) ? $project->images : []
    ))));

    $hasClient = trim((string) $project->client) !== '';
    $hasDate = ! empty($project->start_date);
    $hasAuthor = trim((string) $project->author) !== '';
    $hasPlace = trim((string) $project->place) !== '';
    $hasProjectMeta = $hasClient || $hasDate || $hasAuthor || $hasPlace;
    $projectLink = $project->getMetaData('link', true);

    // Content width, mirroring the "Full width" page template Pages already offer.
    // Registered on the project form in functions/functions.php.
    $isFullWidth = $project->getMetaData('content_width', true) === 'full-width';
    $containerClass = $isFullWidth ? 'container-fluid px-lg-5' : 'container';
    $columnClass = $isFullWidth ? 'col-12' : 'col-lg-8 mx-auto';
@endphp

{!! apply_filters('ads_render', null, 'project_before', ['class' => 'my-2 text-center']) !!}

<!-- portfolio-details section 1 -->
<div class="sec-1-portfolio-details-1 overflow-hidden at-header-offset">
    <div class="{{ $containerClass }}">
        <div class="row">
            <div class="{{ $columnClass }}">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="icon-arrow-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12.1716 8.77815L8.55964e-06 8.77816L1.47897e-06 6.77817L12.1716 6.77816L6.80761 1.41421L8.22183 3.37371e-08L16 7.77815L8.22181 15.5563L6.80759 14.1421L12.1716 8.77815Z" fill="currentColor" />
                        </svg>
                    </i>
                    <span class="text-uppercase neutral-900 fw-600">
                        <span class="text-1">
                            <a href="{{ route('public.index') }}">{{ __('projects') }} /</a>
                        </span>
                        <span class="text-1 neutral-500">
                            {!! BaseHelper::clean($project->name) !!}
                        </span>
                    </span>
                </div>

                <h1 class="section-title d-flex fw-600 reveal-text mb-20">{!! BaseHelper::clean($project->name) !!}</h1>

                @if($project->description)
                    <h2 class="h6 fw-600 reveal-text mb-30">{!! BaseHelper::clean($project->description) !!}</h2>
                @endif

                @if($projectLink)
                    <div class="at-hero-social style-2 justify-content-start">
                        <a href="{{ $projectLink }}" target="_blank" rel="noopener noreferrer">
                            {{ __('Live Demo') }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none">
                                <path d="M5.62494 9.99994L0.562517 10L0.5625 8.75003L4.49994 8.74996L4.5 2.39273L2.27828 4.86124L1.48278 3.97739L5.0625 0L8.64225 3.97739L7.84676 4.86124L5.625 2.3927L5.62494 9.99994Z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($projectImages)
    <!-- portfolio-details images -->
    {!! Theme::partial('portfolio.project-gallery', ['projectImages' => $projectImages, 'project' => $project]) !!}
@endif

<!-- portfolio-details content -->
<div class="pb-120">
    <div class="{{ $containerClass }}">
        @if($hasProjectMeta)
            <div class="row mb-60">
                <div class="{{ $columnClass }}">
                    @if($hasClient)
                        <div class="d-flex justify-content-between border-bottom-100 py-4">
                            <p class="fz-font-md neutral-900 mb-0">{{ __('Client') }}</p>
                            <p class="fz-font-lg fw-600 mb-0 neutral-900">{{ $project->client }}</p>
                        </div>
                    @endif
                    @if($hasDate)
                        <div class="d-flex justify-content-between border-bottom-100 py-4">
                            <p class="fz-font-md neutral-900 mb-0">{{ __('Date') }}</p>
                            <p class="fz-font-lg fw-600 mb-0 neutral-900">{{ Theme::formatDate($project->start_date) }}</p>
                        </div>
                    @endif
                    @if($hasAuthor)
                        <div class="d-flex justify-content-between border-bottom-100 py-4">
                            <p class="fz-font-md neutral-900 mb-0">{{ __('Author') }}</p>
                            <p class="fz-font-lg fw-600 mb-0 neutral-900">{{ $project->author }}</p>
                        </div>
                    @endif
                    @if($hasPlace)
                        <div class="d-flex justify-content-between border-bottom-100 py-4">
                            <p class="fz-font-md neutral-900 mb-0">{{ __('Location') }}</p>
                            <p class="fz-font-lg fw-600 mb-0 neutral-900">{{ $project->place }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="row">
            <div class="{{ $columnClass }}">
                <div class="ck-content">
                    {!! BaseHelper::clean($project->content) !!}
                </div>

                <div class="d-flex align-items-center py-3 border-top mt-5">
                    <span class="fw-bold me-2">{{ __('Share:') }}</span>
                    {!! Theme::renderSocialSharing($project->url, SeoHelper::getDescription(), $project->image) !!}
                </div>

                {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $project) !!}
            </div>
        </div>
    </div>
</div>

{!! apply_filters('ads_render', null, 'project_after', ['class' => 'my-2 text-center']) !!}
