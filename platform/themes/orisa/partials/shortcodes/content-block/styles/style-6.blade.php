{{-- Content Block Style 6 — Home5 "Why Orisa" 3-column bespoke expertise grid (matches sec-2-home-5 in index-5.html) --}}
@php
    $conversionTags = array_filter(array_map('trim', explode('|', (string) $shortcode->description)));
    $listItems = collect($items ?? [])->pluck('title')->filter()->values();
    $currentYear = date('Y');
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);

    // Decorative/bespoke values — sensible Home5 defaults if not configured via attributes.
    $heroCardTitle = $shortcode->hero_title ?: 'Intelligent Systems for Modern Problems.';
    $heroCardExperience = $shortcode->hero_experience ?: '+12 Years <br> of Experience';
    $heroCtaLabel = $shortcode->primary_action_label ?: 'Let\'s build';
    $heroCtaUrl = $shortcode->primary_action_url ?: '#';

    $testimonialQuote = $shortcode->testimonial_quote ?: '"Orisa has a rare ability to bridge the gap between theoretical mathematics and production-grade code. He doesn\'t just build models; he builds engines for real-world growth."';
    $testimonialName = $shortcode->testimonial_name ?: 'Hannah Lee';
    $testimonialRole = $shortcode->testimonial_role ?: 'Creative Director';
    $testimonialRating = (int) ($shortcode->testimonial_rating ?: 3);
    $testimonialSince = $shortcode->testimonial_since ?: '[Since 2012]';

    $statValue = $shortcode->stat_value ?: '5k+';
    $statLabel = $shortcode->stat_label ?: 'Production-grade <br> models deployed';
    $skillsList = array_filter(array_map('trim', explode('|', (string) ($shortcode->skills_list ?: 'Python, C++, JavaScript|PyTorch, TensorFlow, Scikit-learn|Pandas, NumPy, Spark|Docker, Kubernetes, MLflow|AWS / GCP / Azure'))));
    $quoteSmall = $shortcode->quote_small ?: '"High performance starts with clean data. I prioritize rigorous preprocessing and feature engineering to ensure model reliability."';

    $starSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none"><path d="M8.55696 13.6975L12.707 16.2075C13.467 16.6675 14.397 15.9875 14.197 15.1275L13.097 10.4075L16.767 7.2275C17.437 6.6475 17.077 5.5475 16.197 5.4775L11.367 5.0675L9.47696 0.6075C9.13696 -0.2025 7.97696 -0.2025 7.63696 0.6075L5.74696 5.0575L0.916957 5.4675C0.0369575 5.5375 -0.323043 6.6375 0.346957 7.2175L4.01696 10.3975L2.91696 15.1175C2.71696 15.9775 3.64696 16.6575 4.40696 16.1975L8.55696 13.6975Z" fill="currentColor"/></svg>';
    $arrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10" fill="none"><path d="M7.15771 2.62632L1.01015 9.24677L0 8.15892L6.14756 1.53846H0.729157V0H8.58628V8.46154H7.15771V2.62632Z" fill="#1D1D1D"/></svg>';
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-content-block shortcode-content-block-style-6 container-2200">
    <div class="sec-2-home-5 portfolio-area pt-120 pb-120 rounded-5 mx-lg-3 mx-2 fix bg-neutral-100">
        <div class="container">
            {{-- Top: subtitle tag + heading --}}
            <div class="row pb-60 g-2">
                @if ($shortcode->subtitle)
                    <div class="col-xxl-1 col-lg-2">
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{{ $shortcode->subtitle }}</span>
                                <span class="text-2">{{ $shortcode->subtitle }}</span>
                            </span>
                            <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                        </span>
                    </div>
                @endif
                @if ($shortcode->title)
                    <div class="col-xxl-8 col-lg-10">
                        <{{ $titleTag }} class="reveal-text lh-1 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    </div>
                @endif
            </div>

            <div class="row g-3 sec-2-home-5__grid">
                {{-- Column 1: hero card + list card --}}
                <div class="col-xxl-4 col-lg-6">
                    <div class="sec-2-home-5__col p-2 rounded-4 bg-neutral-0">
                        <div class="sec-2-home-5__card sec-2-home-5__card--hero rounded-4 overflow-hidden p-relative">
                            <div class="sec-2-home-5__hero-bg"></div>
                            @if ($styleImage1)
                                {{ RvMedia::image($styleImage1, $heroCardTitle, attributes: ['class' => 'sec-2-home-5__hero-img']) }}
                            @endif
                            <div class="sec-2-home-5__hero-overlay p-absolute top-0 left-0 w-100 h-100 d-flex flex-column justify-content-between p-4">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h4 class="h6 sec-2-home-5__hero-title text-white fw-bold mb-0">{!! BaseHelper::clean($heroCardTitle) !!}</h4>
                                    <span class="text-white opacity-75 text-nowrap">&copy; {{ $currentYear }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                                    <span class="text-white fz-font-body">{!! BaseHelper::clean($heroCardExperience) !!}</span>
                                    <a class="at-btn bg-neutral-0 changeless text-dark py-2 px-3 fz-font-body" href="{{ $heroCtaUrl }}">
                                        <span>
                                            <span class="text-1">{{ $heroCtaLabel }}</span>
                                            <span class="text-2">{{ $heroCtaLabel }}</span>
                                        </span>
                                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if ($listItems->isNotEmpty())
                            <div class="sec-2-home-5__card sec-2-home-5__card--list p-4 d-flex align-items-center">
                                <ul class="sec-2-home-5__list list-unstyled mb-0">
                                    @foreach ($listItems as $item)
                                        <li class="sec-2-home-5__list-item">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Column 2: testimonial card --}}
                <div class="col-xxl-4 col-lg-6">
                    <div class="sec-2-home-5__col">
                        <div class="sec-2-home-5__card sec-2-home-5__card--testimonial p-relative rounded-4 bg-neutral-0 p-4 p-md-5 fix">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                @if ($shortcode->testimonial_avatar)
                                    <div class="sec-2-home-5__avatar rounded-3 overflow-hidden flex-shrink-0">
                                        {{ RvMedia::image($shortcode->testimonial_avatar, $testimonialName, attributes: ['class' => 'img-cover']) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="h6 fw-600 neutral-900 fz-font-md mb-0">{{ $testimonialName }}</h4>
                                    <span class="neutral-500 small fz-font-label">{{ $testimonialRole }}</span>
                                </div>
                            </div>
                            <div class="sec-2-home-5__stars mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="sec-2-home-5__star opacity-25 {{ $i <= $testimonialRating ? 'sec-2-home-5__star--filled' : '' }}">{!! $starSvg !!}</span>
                                @endfor
                            </div>
                            <blockquote class="neutral-900 fz-font-lg fw-500 mb-4">{!! BaseHelper::clean($testimonialQuote) !!}</blockquote>
                            <span class="neutral-500 small d-block mt-60 pb-145">{{ $testimonialSince }}</span>
                            @if ($styleImage2)
                                <div class="sec-2-home-5__product-img-wrap p-absolute bottom-0 end-0">
                                    {{ RvMedia::image($styleImage2, 'Product', attributes: ['class' => 'sec-2-home-5__product-img at_fade_anim', 'data-delay' => '.5']) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Column 3: 3 small cards --}}
                <div class="col-xxl-4 col-12">
                    <div class="sec-2-home-5__col sec-2-home-5__col--three">
                        <div class="sec-2-home-5__card sec-2-home-5__card--small rounded-4 bg-neutral-0 p-4 p-md-5 p-relative fix mb-20">
                            <div class="pb-80 d-flex justify-content-between flex-md-row flex-column">
                                <div>
                                    <div class="sec-2-home-5__stat mb-2">{{ $statValue }}</div>
                                    <p class="neutral-900 fw-semibold mb-4">{!! BaseHelper::clean($statLabel) !!}</p>
                                </div>
                                @if (! empty($skillsList))
                                    <ul class="sec-2-home-5__list sec-2-home-5__list--sm list-unstyled mb-0">
                                        @foreach ($skillsList as $skill)
                                            <li class="sec-2-home-5__list-item">{{ $skill }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            @if ($styleImage3)
                                <div class="p-absolute bottom-0 end-0">
                                    {{ RvMedia::image($styleImage3, 'decoration', attributes: ['class' => 'at_fade_anim']) }}
                                </div>
                            @endif
                        </div>
                        <div class="row g-2">
                            @if ($styleImage4)
                                <div class="col-md-6">
                                    <div class="sec-2-home-5__card sec-2-home-5__card--small sec-2-home-5__card--img rounded-4 h-100 fix">
                                        <div class="img">
                                            {{ RvMedia::image($styleImage4, 'Product', attributes: ['class' => 'sec-2-home-5__thumb-img at_fade_anim', 'data-delay' => '.5']) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="sec-2-home-5__card sec-2-home-5__card--small sec-2-home-5__card--quote bg-neutral-0 overflow-hidden h-100">
                                    <div class="sec-2-home-5__quote-icon mb-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                            <path d="M6.75 13.5C10.4779 13.5 13.5 10.4779 13.5 6.75C13.5 10.477 16.5207 13.4986 20.2474 13.5C16.5207 13.5014 13.5 16.523 13.5 20.25C13.5 16.5221 10.4779 13.5 6.75 13.5C3.02208 13.5 4.58005e-07 16.5221 2.95052e-07 20.25L0 27L6.75 27C10.4779 27 13.5 23.9779 13.5 20.25C13.5 23.9779 16.5221 27 20.25 27L27 27L27 20.25C27 16.523 23.9794 13.5014 20.2526 13.5C23.9794 13.4986 27 10.477 27 6.75L27 4.54184e-06L20.25 4.83689e-06C16.5221 3.09249e-06 13.5 3.02208 13.5 6.75C13.5 3.02208 10.4779 3.35669e-06 6.75 1.6123e-06L2.36042e-06 0L1.47526e-06 6.75C9.86401e-07 10.4779 3.02208 13.5 6.75 13.5Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    <blockquote class="neutral-900 fz-font-md fw-500 mb-0">{!! BaseHelper::clean($quoteSmall) !!}</blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom: conversion tags --}}
            @if (! empty($conversionTags))
                <div class="row pt-70">
                    <div class="col-12 order-5">
                        <div class="d-flex flex-wrap align-items-center justify-content-lg-between justify-content-center gap-md-5 gap-2 at_fade_anim" data-fade-from="bottom" data-duration="2">
                            @foreach ($conversionTags as $tag)
                                <p class="neutral-900 mb-0">[ {{ $tag }} ]</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
