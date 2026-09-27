{{-- Projects Style 2 — alt-portfolio card with image overlay, place as pill label (portfolio-2.html) --}}
@php
    $plusSvg  = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none"><path d="M4.512 10.8V0H6.984V10.8H4.512ZM0 6.6V4.2H11.52V6.6H0Z" fill="currentColor" /></svg>';
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-projects shortcode-projects-style-2 sec-1-portfolio-2 overflow-hidden pt-150 pb-110 border-bottom-100">

    {{-- Section header — centred layout --}}
    @if($shortcode->title || $shortcode->subtitle)
        <div class="container pb-60">
            <div class="row align-items-end">
                <div class="col-xxl-8 mx-auto text-center">
                    @if($shortcode->title)
                        <{{ $titleTag }} class="fz-ds-1 fw-500 {{ $titleSizeClass }}">{{ $shortcode->title }}</{{ $titleTag }}>
                    @endif
                    @if($shortcode->subtitle)
                        <p class="fz-font-lg neutral-900">{{ $shortcode->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 pb-30"></div>

            {{-- Project cards --}}
            @foreach($projects as $project)
                <div class="alt-portfolio-item card-portfolio mb-50 at-hover-item col-lg-6">
                    <a href="{{ $project->url }}" class="alt-portfolio-thumb mb-15 p-relative fix d-block">
                        <img class="w-100"
                            src="{{ RvMedia::getImageUrl($project->image, null, false, RvMedia::getDefaultImage()) }}"
                            alt="{{ $project->name }}">
                        <div class="alt-portfolio-btn">
                            <div class="content changeless">
                                {{-- Use place as a label pill when available --}}
                                @if($project->place)
                                    <span class="bg-transparent text-uppercase border px-3 py-1 rounded-pill common-white fz-font-label">
                                        {{ $project->place }}
                                    </span>
                                @endif
                                @if($project->description)
                                    <p class="text-white fz-font-md mb-0 mt-10 text-truncate-3 des pr-250">
                                        {{ $project->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        @if($project->is_featured)
                            <span class="alt-portfolio-tag bg-theme-primary px-3 py-2 rounded-pill p-absolute top-0 end-0 m-4 fz-10 fw-600 text-white">
                                {{ __('FEATURED CASE') }}
                            </span>
                        @endif
                    </a>
                    <div class="alt-portfolio-content d-flex justify-content-between">
                        <h2 class="h5 alt-portfolio-title mb-0 fw-600">
                            <a href="{{ $project->url }}" class="common-underline">{{ $project->name }}</a>
                        </h2>
                        <a href="{{ $project->url }}" class="alt-portfolio-plus neutral-950 d-flex align-items-center gap-2">
                            <span class="fz-font-label neutral-900 text-uppercase fw-600">{{ __('View case') }}</span>
                            {!! $plusSvg !!}
                        </a>
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
